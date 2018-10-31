<?php
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "profiles";
 
    // object properties
    public $login_name;
    public $cryptopassword;
    public $realname;
 
    // constructor with $db as database connection
    public function __construct($db){
        $conn = $db;
    }
}