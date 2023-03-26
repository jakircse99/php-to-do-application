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

// sidebar profile pic

function displayProfilePic($_userId) {
    global $conn;
    $query = "SELECT profilePic from users WHERE id = {$_userId}";
    $result = mysqli_query($conn, $query);
    $_data = '';
    if(mysqli_num_rows($result)> 0) {
        $_data = mysqli_fetch_column($result);
    }
    echo $_data;
}

// display greeting
function greeting() {
    $h = date("G");
    if($h >= 5 && $h <=10) {
        echo "Good morging";
    }else if ($h >= 12 && $h <= 15) {
        echo "Good afternoon";
    }else {
        echo "Good evening";
    }
}

// dashboard profile name
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

// display date 
date_default_timezone_set("Asia/Dhaka");
function displayDate() {
    $d = date("l, jS F, Y");
    echo $d;
}

// tasks details

function getTodayTasks($userId) {
    global $conn;
    $query = "SELECT * FROM tasks WHERE user_id = '{$userId}' &&  task_date = CURDATE()";
    $result = mysqli_query($conn, $query);
    $data = array();
    if(mysqli_num_rows($result)> 0) {
        while($_data = mysqli_fetch_assoc($result)) {
            array_push($data, $_data);
        }
    }
    return $data;
}

function getTomorrowTasks($userId) {
    global $conn;
    $query = "SELECT * FROM tasks WHERE user_id = '{$userId}' &&  task_date = CURDATE()+1";
    $result = mysqli_query($conn, $query);
    $data = array();
    if(mysqli_num_rows($result)> 0) {
        while($_data = mysqli_fetch_assoc($result)) {
            array_push($data, $_data);
        }
    }
    return $data;
}



