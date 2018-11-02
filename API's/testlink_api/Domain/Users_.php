<?php
class User {

    const role_TEST_DESIGNER =   4;
    const role_GUEST         =   5;
    const role_SENIOR_TESTER =   6;
    const role_TESTER        =   7;
    const role_ADMIN         =   8;
    const role_LEADER        =   9;
 
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
    public $role_id;
 
    // constructor with $db as database connection
    public function __construct($db){
        $conn = $db;
    }
}