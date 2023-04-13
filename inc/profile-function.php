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

// profile data display

function profileData($userId) {
    global $conn;
    $query = "SELECT name, email, password, profilepic FROM users WHERE id ='{$userId}' LIMIT 1";
    $result = mysqli_query($conn, $query);
    // $data = array();
    if(mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
    }
    return $data;
}

// declare necessary variable

$action = $_POST['action'] ?? 0;
$status = 0;
$userId = $_SESSION['id'] ?? 0;


$name = $email = $oldpassword = $newPassword = '';
$profilePic = [];
$nameErr = $emailErr = $oldPasswordErr = $newPasswordErr = $profilePicErr = '';

// sanitize and validate user input
if('profile-update' === $action) {
    if(empty($_POST['name'])) {
        $nameErr = "Name is missing";
    } else {
        if(!preg_match("/^[a-zA-Z-' ]*$/", $_POST['name'])) {
            $nameErr = "Only latters and white space allowed";
        }else {
            $name = validateUserInput($_POST['name']);
        }
    }
    if(empty($_POST['email'])) {
        $emailErr = "Email is required";
    }else {
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $emailErr = "Invalid email format";
        }else {
            $email = validateUserInput($_POST['email']);
        }
    }

    if(empty($_POST['old-pass'])) {
        $oldPasswordErr = "old password is required";
    }else {
        if(6 > strlen(strval($_POST['old-pass']))) {
            $oldPasswordErr = "old password must be greater than 6 character";
        }else {
           $oldPassword = validateUserInput($_POST['old-pass']);

        }
    }

    if(empty($_POST['new-pass'])) {
        $newPasswordErr = "New password is required";
    }else {
        if(6 > strlen(strval($_POST['new-pass']))) {
            $newPasswordErr = "New password must be greater than 6 character";
        }else {
            $newPassword = validateUserInput($_POST['new-pass']);
        }
    }
    
    
    
    
    
    $fileSize = $_FILES['profile-pic']["size"] ?? '';
    if($fileSize == 0) {
        $profilePicErr = "Profile picture is missing";
    } else {
        if($_FILES['profile-pic']) {
            $imageFileType = strtolower(pathinfo(basename($_FILES['profile-pic']['name']), PATHINFO_EXTENSION));
            $check = getimagesize($_FILES['profile-pic']['tmp_name']);
            if($check !== false) {
                if($_FILES['profile-pic']['size'] > 50 * 1024) {
                $profilePicErr = "Sorry, your file is to large.";
                }else {
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    $profilePicErr = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                 } else {
                    $imageWidth = $check[0];
                    $imageHeight = $check[1];
                        if($imageWidth != 300 && $imageHeight != 300) {
                            $profilePicErr = "Image size must be 300 * 300 px";
                        } else {
                            $profilePic = $_FILES['profile-pic'];
                        }
                    }
                }
            }else {
                $profilePicErr = "File is not an image";
            }
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


if('profile-update' === $action) {
    if($name && $email && $newPassword && $oldPassword && $profilePic && $userId) {
        $queryPass = "SELECT password FROM users WHERE id='{$userId}' LIMIT 1"; 
        $result = mysqli_query($conn, $queryPass);
        $password = mysqli_fetch_column($result);
        if(password_verify($oldPassword, $password)) {
            $targetFile = "../profile-pic/". basename($profilePic['name']);
            $fileName = basename($profilePic['name']);
            move_uploaded_file($profilePic['tmp_name'], $targetFile);
            $passHash = password_hash($newPassword, PASSWORD_BCRYPT);
            $query = "UPDATE users SET name ='{$name}', email = '{$email}', password = '{$passHash}', profilepic = '{$fileName}' WHERE id = '{$userId}'";
            mysqli_query($conn, $query);
            header('location: profile.php?status=update_success');
        }else {
            header('location: profile.php?status=pass_wrong');
        }
    }
}
