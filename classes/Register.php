<?php 

    class Register{

        private $connection;
        public $errors = [];
        
        public function __construct($connection){
            $this->connection = $connection;
            
            if(isset($_SESSION['username'])){
                header('Location: ' . Config::PATH);
            }
        }
        
        public function showError(){
            if(!empty($this->errors)){
                echo '<div class="form-error">' . $this->errors[0] . '</div>';
            }
        }
        
        public function validate($username, $mail, $passwort, $re_passwort){
            
            $error_msg = [
                "username" =>
                    ["short" => "Der Username ist zu kurz (mind. 3 Zeichen)",
                    "long" => "Der Username ist zu lang (max. 15 Zeichen",
                    "existing" => "Der Username ist bereits besetzt",
                    "whitespaces" => "Der Username darf keine Leerzeichen haben"],
                
                "mail" =>
                    ["invalid" => "Die E-mail ist ungültig",
                    "existing" => "Die E-mail Adresse ist bereits besetzt",
                    "long" => "Die E-mail ist zu lang (max. 120. Zeichen"],
                
                "passwort" =>
                    ["short" => "Das Passwort ist zu kurz (mind. 4 Zeichen)",
                    "long" => "Das Passwort ist zu lang (max. 90 Zeichen"],
                
                "re_passwort" =>
                    ["invalid" => "Das Passwort stimmt nicht mit"]
            ];
            
            # username 
            
            $username = trim(htmlspecialchars(($username)));
            $username_rep = str_replace(" ", "", $username);
            
            if(!strlen($username) >= 3){
                array_push($this->errors, $error_msg["username"]["short"]);
            }
            
            if(strlen($username) > 15){
                array_push($this->errors, $error_msg["username"]["long"]);
            }
            
            $existing = $this->connection->query("SELECT * FROM users WHERE username = :username", [
               "username" => $username 
            ]);
            
                        
            if($existing->num_rows){
                array_push($this->errors, $error_msg["username"]["existing"]);
            }
            
            if($username != $username_rep) {
                array_push($this->errors, $error_msg["username"]["whitespaces"]);
            }
            
            #mail
            
            $mail = trim(htmlspecialchars($mail));
            
            if(strlen($mail) > 120){
                array_push($this->errors, $error_msg["mail"]["long"]);
            }
            
            if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
		array_push($this->errors, $error_msg["mail"]["invalid"]);
            }
            
            $existingmail = $this->connection->query("SELECT * FROM users WHERE mail = :mail", [
                "mail" => $mail
            ]);
            
            if($existingmail->num_rows){
                array_push($this->errors, $error_msg["mail"]["existing"]);
            }
            
            #passwort
            if(!strlen($passwort) >= 4){
                array_push($this->errors, $error_msg["passwort"]["short"]);
            }
            
            if(strlen($passwort) > 90){
                array_push($this->errors, $error_msg["passwort"]["long"]);
            }
            
            if($passwort != $re_passwort){
                array_push($this->errors, $error_msg["re_passwort"]["invalid"]);
            }
           
            
            if(!empty($this->errors)) {
                return false;
            }
            
            return true;
            
        }
        
        public function execute($username, $mail, $passwort){
            $username = trim(htmlspecialchars($username));
            $passwort = hash("sha224", md5(trim(htmlspecialchars($passwort))));
            $mail = trim(htmlspecialchars($mail));
            
            $this->connection->query("INSERT INTO users (username, password, mail) VALUES (:username, :password, :mail)", [
                "username" => $username,
                "password" => $passwort,
                "mail" => $mail
            ]);    
        }
        
    }

?>