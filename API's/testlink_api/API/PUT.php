<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../Data/connection.php';
include_once '../Data/Users_.php';
include_once '../Domain/Users_.php';

// instantiate database and users object
$database = new Connection();
$db = $database->getConnection();

// initialize object
$users = new User($db);

$login         =    $_GET['login'];
$password      =    $_GET['password'];
$email         =    $_GET['email'];
$first         =    $_GET['first'];
$last          =    $_GET['last'];
$cookie_string =    $_GET['cookie_string'];

$role_id = $users::role_GUEST;

if (isset($_GET['role_id']))
  $role_id = $_GET['role_id'];

if (!empty($login)      &&
    !empty($password)   &&
    !empty($email)      &&
	  !empty($first)      &&
	  !empty($last)       &&
	  !empty($cookie_string) ) {

  if (create($db, $login, $password, $email, $first, $last, $cookie_string, $role_id)) {
  	http_response_code(201);
  	echo json_encode(array("Message" => "User has been created successful."));
  }
} else {
	http_response_code(400);
	echo json_encode(array("Message" => "Data is incomplete."));
}