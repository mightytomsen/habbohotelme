<?php

    class Login {

        private $connection;
        public $errors = [];

        public function __construct($connection) {
            $this->connection = $connection;
            $this->cookie_time = time()+60*60;
            
            if(!isset($_SESSION['sessionid'])){
                session_regenerate_id();
                $_SESSION['sessionid'] = session_id();
            }
            
             if(!isset($_SESSION['securityid'])){
                $_SESSION['securityid'] = hash('sha224', md5(session_id()));
            }
            
        }

        public function showError(){
            if(!empty($this->errors)){
                echo '<div class"error">' . $this->errors . '</div>';
            }
        }

        public function execute($username, $password){

            $password = hash("sha224", md5(trim(htmlspecialchars($password))));
            if(!empty($username) AND !empty($password)){
                $query = $this->connection->query("SELECT * FROM users WHERE username = :username AND password = :password", [
                    "username" => $username,
                    "password" => $password
                ]);

                $row = $query->fetch_assoc();

                if($query->num_rows){
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['avatar'] = $row['avatar'];
                    $ip = $_SERVER['REMOTE_ADDR'];

                    $this->connection->query('INSERT INTO security_login (username, securityid, sessionid, expire, ipaddress) VALUES (:username, :security_id, :session_id, :expire, :ipaddress)', [
                        "username" => $_SESSION['username'],
                        "security_id" => $_SESSION['securityid'],
                        "session_id" => $_SESSION['sessionid'],
                        "expire" => $this->cookie_time,
                        "ipaddress" => $ip
                    ]);

                    setcookie('username', $_SESSION['username'], time()+60*60);
                    setcookie('securityid', $_SESSION['securityid'], time()+60*60);
                    setcookie('sessionid', $_SESSION['sessionid'], time()+60*60); 

                    header('Location: ' . Config::PATH . '/forum');
                }
            }
        }

        public function LogOut(){
            $this->connection->query('DELETE FROM security_login WHERE username = :username AND sessionid = :sessionid AND securityid = :securityid', [
               'username' => $_SESSION['username'],
                'sessionid' => $_SESSION['sessionid'], 
                'securityid' => $_SESSION['securityid']
            ]);
			
            $_SESSION['username'] = '';
            $_SESSION['securityid'] = '';
            $_SESSION['sessionid'] = '';
            
            setcookie('username', "", -1);
            setcookie('securityid', "", -1);
            setcookie('sessionid', "", -1); 
            
            session_destroy();
        }
        
        public function IsLoggedIn($header = false){
            if(isset($_SESSION['username'], $_SESSION['sessionid'], $_SESSION['securityid'])) {
                $query = $this->connection->query('SELECT * FROM security_login WHERE username = :username AND sessionid = :sessionid AND securityid = :securityid', [
                   'username' => $_SESSION['username'],
                    'sessionid' => $_SESSION['sessionid'], 
                    'securityid' => $_SESSION['securityid']
                ]);
              
                
                if($query->num_rows){
                    $row = $query->fetch_assoc();
                    if(time() < $row['expire']){
                        if($row['cookies']){
                            if(!$header) {
                               setcookie('username', $_SESSION['username'], time()+60*60);
                               setcookie('securityid', $_SESSION['securityid'], time()+60*60);
                               setcookie('sessionid', $_SESSION['sessionid'], time()+60*60); 
                            }
                        }
                        return true;
                    } else {
                        $this->LogOut();
                    }
                }  
                
            } else if(isset($_COOKIE['username'], $_COOKIE['securityid'], $_COOKIE['sessionid'])){
                $query = $this->connection->query('SELECT * FROM security_login WHERE username = :username AND sessionid = :sessionid AND securityid = :securityid', [
                   'username' => $_COOKIE['username'],
                    'sessionid' => $_COOKIE['sessionid'], 
                    'securityid' => $_COOKIE['securityid']
                ]);
              
                
                if($query->num_rows){
                    $row = $query->fetch_assoc();
                    if(time() < $row['expire']){
                        if(!$header) {
                            $_SESSION['username'] = $_COOKIE['username'];
                            $_SESSION['sessionid'] = $_COOKIE['sessionid'];
                            $_SESSION['securityid'] = $_COOKIE['securityid'];
                        }
                        return true;
                    } else {
                        $this->LogOut();
                    }
                }  
            } return false;               
        }
    }

?>
