<?php
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "users";
 
    // object properties
    public $id;
    public $login;
    public $password;
    public $email;
    public $first;
    public $last;
    public $cookie_string;
 
    // constructor with $db as database connection
    public function __construct($db){
        $conn = $db;
    }
}