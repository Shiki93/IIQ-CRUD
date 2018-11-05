<?php
error_reporting(E_ALL ^ E_WARNING);
include_once './xml.php';
$dir = 'C:\Program Files (x86)\Jenkins\users\\';

$dirs = scandir($dir);
$qDir = count($dirs);

$users_arr=array();
$users_arr["records"]=array();

for ($i = 2; $i < $qDir; $i++) {
	$myfile = fopen($dir . $dirs[$i] . "\\" . "config.xml", "r") or die("Unable to open file!");
	$str_xml = (fread($myfile, 10000));

	$xml=simplexml_load_string($str_xml) or die("Error: Cannot create object");

	$users_item=array(
            "fullName"      => $xml->fullName,
            "passwordHash"  => $xml->properties->{'hudson.security.HudsonPrivateSecurityRealm_-Details'}->passwordHash,
        );
	array_push($users_arr["records"], $users_item);
}

// set response code - 200 OK
http_response_code(200);

// show userss data in json format
echo json_encode($users_arr);