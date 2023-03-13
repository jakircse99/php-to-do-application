<?php

require_once (dirname(__FILE__).'/../config/config.php');
$conn = mysqli_connect(HOST_NAME, DB_USER, DB_PASSWORD, DB_NAME);

if(!$conn) {
    throw new Exception("Database connection not established");
}
// error and action status
function getActionMessage ($statusValue = 0) {
    $status = [
        '0' => '',
        '1' => "User and password didn\'t match",
        '2' => "Email doesn't exist",
        '3' => "Email has been already registered",
        '4' => "Congratulations, account created successfully",
    ];
    return $status[$statusValue];
}


function getProfileName($_userId) {
    global $conn;
    $query = "SELECT name FROM users WHERE id = '{$_userId}' LIMIT 1";
    $result = mysqli_query($conn, $query);
    $_data = '';

    if(mysqli_num_rows($result)> 0) {
        $_data = mysqli_fetch_assoc($result);
    }
    

    return $_data['name'];
}



