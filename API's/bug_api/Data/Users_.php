<?php
// read Users
include_once '../Security/bz_crypt.php';

function create($db, $login_name, $cryptopassword, $realname) {
    $bz_crypt = new bz_crypt();
    $hash = $bz_crypt->getHash($cryptopassword);

    $query = "INSERT INTO profiles(login_name, cryptpassword, realname, extern_id) VALUES ('" . $login_name . "', '" . $hash . "', '" . $realname . "', '" . $login_name ."');";
    $stmt1 = $db->prepare($query);

    if ($stmt1->execute()) {
        $last = readLast($db);
        $row = $last->fetch(PDO::FETCH_ASSOC);

        extract($row);

        $query = "INSERT INTO logincookies(cookie, userid) VALUES ('" . $login_name . "', " . $userid . "), ('0" . $login_name . "', " . $userid . ");";
        $stmt2 = $db->prepare($query);

        if ($stmt2->execute()) {
            return true;
        }
    } else {
        return false;
    }

    

    if ($stmt1->execute() && $stmt1->execute()) {
        return true;
    }
    return false;
}

function create2($db, $login_name, $cryptopassword, $realname) {

    $query = "INSERT INTO profiles(login_name, cryptpassword, realname, extern_id) VALUES ('" . $login_name . "', '" . $cryptopassword . "', '" . $realname . "', '" . $login_name ."');";
    $stmt1 = $db->prepare($query);

    if ($stmt1->execute()) {
        $last = readLast($db);
        $row = $last->fetch(PDO::FETCH_ASSOC);

        extract($row);

        $query = "INSERT INTO logincookies(cookie, userid) VALUES ('" . $login_name . "', " . $userid . "), ('0" . $login_name . "', " . $userid . ");";
        $stmt2 = $db->prepare($query);

        if ($stmt2->execute()) {
            return true;
        }
    } else {
        return false;
    }

    

    if ($stmt1->execute() && $stmt1->execute()) {
        return true;
    }
    return false;
}

function read($db){
 
    // select all query
    $query = "SELECT login_name, cryptpassword, realname FROM profiles;";
 
    // prepare query statement
    $stmt = $db->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}

function readLast($db){
 
    // select all query
    $query = "SELECT userid, login_name, cryptpassword, realname FROM profiles ORDER BY userid DESC LIMIT 1;";
 
    // prepare query statement
    $stmt = $db->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}

function update($db, $login_name, $cryptpassword, $realname) {

    $query = "UPDATE profiles SET cryptpassword = '" . $cryptpassword . "', realname = '" . $realname . "' WHERE login_name = '" . $login_name . "';";
    $stmt = $db->prepare($query);

    if ($stmt->execute()) {
        return true;
    }
    return false;
}

function delete($db, $login_name) {

    $query = "DELETE FROM profiles WHERE login_name = '" . $login_name . "';";
    $stmt = $db->prepare($query);

    if ($stmt->execute()) {
        return true;
    }
    return false;
}