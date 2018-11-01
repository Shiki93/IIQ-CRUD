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
$where = '';

if (isset($_GET['email'])) {
    $where = " WHERE email = '" . $_GET['email'] . "'";
}

// query userss
$stmt = read($db, $where);
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
            "id"            => $id,
            "login"         => $login,
            "password"      => decript($password),
            "email"         => $email,
            "first"         => $first,
            "last"          => $last,
            "cookie_string" => $cookie_string,
            "role_id"       => $role_id,
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

function decript($word) {
    $path = 'https://www.md5.pinasthika.com/api/decrypt?value=' . $word;
    $json = curl_get_contents($path);
    $json = json_decode($json);
    $pass = json_encode($json->result);
    if ( $pass[0] == '{')
        return "";
    return $json->result;
}

function curl_get_contents($url)
{
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}