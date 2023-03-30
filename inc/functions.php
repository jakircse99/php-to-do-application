<?php
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die ("<h2>Access Denied!</h2> This file is protected and not available to public.");
    }
    
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

// incomplete tasks

function getIncompleteTasks($userId) {
    global $conn;
    $query = "SELECT * FROM tasks WHERE user_id = '{$userId}' AND status = 'to-do'";
    $result = mysqli_query($conn, $query);
    $data = array();
    if(mysqli_num_rows($result)> 0) {
        while($_data = mysqli_fetch_assoc($result)) {
            array_push($data, $_data);
        }
    }
    return $data;
}

// complete tasks 

function getCompleteTasks($userId) {
    global $conn;
    $query = "SELECT * FROM tasks WHERE user_id = '{$userId}' AND status = 'done'";
    $result = mysqli_query($conn, $query);
    $data = array();
    if(mysqli_num_rows($result)> 0) {
        while($_data = mysqli_fetch_assoc($result)) {
            array_push($data, $_data);
        }
    }
    return $data;
}

// complete, incomplete and delete action 

$tasksAction = $_GET['task'] ?? '';
$id = $_GET['id'] ?? '';

if($tasksAction == 'complete') {
    $query = "UPDATE tasks SET status = 'done' WHERE id = '{$id}'";
    mysqli_query($conn, $query);
    header('location: all-tasks.php');
}else if ($tasksAction == 'incomplete') {
    $query = "UPDATE tasks SET status = 'to-do' WHERE id = '{$id}'";
    mysqli_query($conn, $query);
    header('location: all-tasks.php');
} else if($tasksAction == 'delete') {
    $query = "DELETE FROM tasks WHERE id = '{$id}'";
    mysqli_query($conn, $query);
    header('location: all-tasks.php?status=delete');
}

// get task data form server

function getTaskData ($id) {
    global $conn;
    $query = "SELECT task_name, task_date, progress FROM tasks WHERE id = '{$id}' LIMIT 1";
    $result = mysqli_query($conn, $query);
    $data = array();
    if(mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
    }
    return $data;
}

// update edited task data 

$action = $_POST['action'] ?? '';
$id = $_GET['id'] ?? '';
$taskName = $taskDate = $progress = '';
$taskNameErr = $taskDateErr = $progressErr = '';

if('update' == $action) {
    if(empty('task-name')) {
        $taskNameErr = 'Name is missing';
    }else {
        if(strlen($_POST['task-name']) > 50) {
            $taskNameErr = 'Task name should be less then 50 letters';
        }else {
            $taskName = validateEditedInput($_POST['task-name']);
        }
    }

    if(empty($_POST['task-date'])) {
        $taskDateErr = "Date is missing";
    } else {
        $date = $_POST['task-date'];
        $y = substr($date, 0, 4);
        $m = substr($date, 5, 2);
        $d = substr($date, 8, 2);
        if(checkdate($m, $d, $y)) {
            $taskDate = validateEditedInput($_POST['task-date']);
        } else {
            $taskDateErr = "Date is invalid";
        }
    }

    if($_POST['progress'] < 0 && $_POST['progress'] > 100) {
        $progressErr = "Progress should be between 0 and 100";
    } else {
        $progress = validateEditedInput($_POST['progress']);
    }
}

function validateEditedInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


if('update' == $action) {
    if($taskName && $taskDate && ($progress !='') && $id) {
        $query = "UPDATE tasks SET task_name = '{$taskName}', task_date = '{$taskDate}', progress = '{$progress}' WHERE id='{$id}'";
        mysqli_query($conn, $query);
        header('location: all-tasks.php?status=update');
    }
}








