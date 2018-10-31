<?php
class Connection{
 
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "bugs";
    private $username = "root";
    private $password = "root";
    public $conn;
 
    // get the database connection
    public function getConnection(){
 
        $conn = null;
 
        try{
            $conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $conn;
    }
}