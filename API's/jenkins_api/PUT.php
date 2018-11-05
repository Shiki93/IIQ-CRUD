<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once './xml.php';

// initialize object
if (isset($_GET['user']) && isset($_GET['pass'])) {
  $user = $_GET['user'];
  $pass = $_GET['pass'];

  if (!empty($user) &&
      !empty($pass) ) {

    $var =  genUserXML($user, $pass);

    $dir = 'C:\Program Files (x86)\Jenkins\users' . '\\' . $user . "\\";
    if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
    }

    $myfile = fopen($dir . "config.xml", "w") or die("Unable to open file!");
    $txt = genUserXML($user, $pass);
    fwrite($myfile, $txt);
    fclose($myfile);

    http_response_code(200);
    echo json_encode(array("Message" => "User has been created successful."));
  } else {
  	http_response_code(400);
  	echo json_encode(array("Message" => "Data is incomplete."));
  }
}