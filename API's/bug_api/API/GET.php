<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../Data/connection.php';
include_once '../Data/Users_.php';
include_once '../Domain/Users_.php';
 
// instantiate database and users object
$database = new Connection();
$db = $database->getConnection();
 
// initialize object
$users = new User($db);
 
// query userss
$stmt = read($db);
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // userss array
    $userss_arr=array();
    $userss_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $users_item=array(
            "login_name"     => $login_name,
            "cryptpassword" => $cryptpassword,
            "realname"       => $realname
        );
 
        array_push($userss_arr["records"], $users_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show userss data in json format
    echo json_encode($userss_arr);
} else {
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no userss found
    echo json_encode(
        array("message" => "No users found.")
    );
}