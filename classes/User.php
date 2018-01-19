<?php
class User {
    public $connection;
    
    public function __construct() {
        $this->connection = $GLOBALS['connection'];
    }
    
    public function getUserinfo($name, $col) {
        $query = $this->connection->query('SELECT ' . $col . ' FROM users WHERE username = :name', [
            "name" => $name
        ]);
        
        if($query->num_rows) {
            $result = $query->fetch_assoc();
            return $result[$col];
        }
        
        return false;
    }
}
