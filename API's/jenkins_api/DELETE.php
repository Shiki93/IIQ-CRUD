<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// initialize object
if (isset($_GET['user'])) {
  $user = $_GET['user'];

  if (!empty($user)) {

    $dir = 'C:\Program Files (x86)\Jenkins\users' . '\\' . $user;

    if (file_exists($dir)) {
        // Delete each element inside the folder
        $dirs = scandir($dir);
        $qDir = count($dirs);

        for ($i = 2; $i < $qDir; $i++) {
          unlink($dir . "\\" . $dirs[$i]);
        }

        // Delete forder
        rmdir($dir);

        http_response_code(200);
        echo json_encode(array("Message" => "User has been deleted successful."));
    } else {
      http_response_code(400);
      echo json_encode(array("Message" => "User not exists in Jenkins."));
    }

  } else {
  	http_response_code(400);
  	echo json_encode(array("Message" => "Data is incomplete."));
  }
}