<?php
session_start();
require_once (dirname(__FILE__).'/../config/config.php');
$conn = mysqli_connect(HOST_NAME, DB_USER, DB_PASSWORD, DB_NAME);

if($conn) {
    echo "connect successfully";
}else {
    throw new Exception("Database connection not establish");
}

// sanitize add validate add task form
$taskName = $taskDate = '';
$taskNameErr = $taskDateErr = '';
$userId = $_SESSION['id'] ?? 0;
if($_SERVER['REQUEST_METHOD'] == "POST") {
    if(empty($_POST['task-name'])) {
        $taskNameErr = "Task name is missing";
    }else {
        if(strlen($_POST['task-name']) > 50) {
            $taskNameErr = "Task name should be less then 50 letters";
        } else {
            $taskName = ValidateUserInput($_POST['task-name']);
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
            $taskDate = validateUserInput($_POST['task-date']);
        } else {
            $taskDateErr = "Date is invalid";
        }
    }
}

// input validation function
function validateUserInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if($taskName && $taskDate && $userId) {
        $query = "INSERT INTO tasks(user_id, task_name, task_date) VALUES ('{$userId}','{$taskName}', '{$taskDate}')";
        if(mysqli_query($conn, $query)) {
            header('location: add-task.php?status=1');
        } else {
            header('location: add-task.php?status=2');
        }
    }
}