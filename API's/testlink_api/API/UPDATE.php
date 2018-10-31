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

$key  = "";
$type = "";

if (isset($_GET['id'])) {
	$key       =    $_GET['id'];
	$type      =    "id";
} else {
	$key       =    $_GET['email'];
	$type      =    "email";
}

$login         =    $_GET['login'];
$password      =    $_GET['password'];
$first         =    $_GET['first'];
$last          =    $_GET['last'];

if (!empty($key)        &&
	!empty($login)      &&
    !empty($password)   &&
	!empty($first)      &&
	!empty($last)      ) {

  if (update($db, $key, $login, $password, $first, $last, $type)) {
  	http_response_code(201);
  	echo json_encode(array("Message" => "User has been updated successful."));
  }
} else {
	http_response_code(400);
	echo json_encode(array("Message" => "Data is incomplete."));
}