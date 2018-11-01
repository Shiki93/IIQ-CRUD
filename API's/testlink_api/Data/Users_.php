<?php
// read Users

function create($db, $login, $password, $email, $first, $last, $cookie_string, $role_id) {

    $query = "INSERT INTO users(login, password, email, first, last, cookie_string, role_id)" . 
               " VALUES ('" . $login         . "', " .
                        "'" . $password      . "', " .
                        "'" . $email         . "', " .
                        "'" . $first         . "', " .
                        "'" . $last          . "', " .
                        "'" . $cookie_string . "', " .
                        " " . $role_id       . ");";
    $stmt = $db->prepare($query);
    $stmt->execute();
    return true;
}

function read($db, $where){
 
    // select all query
    $query = "SELECT * FROM users" . $where . ";";
 
    // prepare query statement
    $stmt = $db->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}

function update($db, $key, $login, $password, $first, $last, $type, $role_id) {
    $limit = "";
    if ($type == "email")
        $limit = "'";

    $query = "UPDATE users SET login = '"          . $login         . "', " .
                               "password = '"      . $password      . "', " .
                               "first = '"         . $first         . "', " .
                               "last = '"          . $last          . "', " .
                               "role_id = "        . $role_id       . " "   .
               "WHERE " . $type . " = " . $limit . $key . $limit . ";";
    $stmt = $db->prepare($query);

    if ($stmt->execute()) {
        return true;
    }
    return false;
}

function delete($db, $id) {

    $query = "DELETE FROM users WHERE id = " . $id . ";";
    $stmt = $db->prepare($query);

    if ($stmt->execute()) {
        return true;
    }
    return false;
}

function deleteEmail($db, $email) {

    $query = "DELETE FROM users WHERE email = '" . $email . "';";
    $stmt = $db->prepare($query);

    if ($stmt->execute()) {
        return true;
    }
    return false;
}