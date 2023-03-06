<?php
session_start();
// database connection
include_once "./config/config.php";
include_once "./inc/functions.php";
mysqli_report(MYSQLI_REPORT_OFF);
$conn = mysqli_connect(HOST_NAME, DB_USER, DB_PASSWORD, DB_NAME);

if($conn) {
    echo "connect successfully";
}else {
    throw new Exception("Database connection not establish");
}

// declare necessary variable

$action = $_POST['action'] ?? 0;
$status = 0;


$name = $email = $password = $confirmPassword = $profilePic = '';
$nameErr = $emailErr = $passwordErr = $confirmPasswordErr = $profilePicErr = '';

// sanitize and validate user input
if($_SERVER['REQUEST_METHOD'] == "POST") {
    if(empty($_POST['name'])) {
        $nameErr = "Name is missing";
    } else {
        if(!preg_match("/^[a-zA-Z-' ]*$/", $_POST['name'])) {
            $nameErr = "Only latters and white space allowed";
        }else {
            $name = $_POST['name'];
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

    if(empty($_POST['password'])) {
        $passwordErr = "Password is required";
    }else {
        if(6 > strlen(strval($_POST['password']))) {
            $passwordErr = "Password must be greater than 6 character";
        }else {
           $password = $_POST['password'];

        }
    }

    if(empty($_POST['confirm-pwd'])) {
        $confirmPasswordErr = "Confirm password is required";
    }else {
        if($_POST['password'] != $_POST['confirm-pwd']) {
            $confirmPasswordErr = "Confirm password doesn't match";
        }else {
            $password = validateUserInput($_POST['confirm-pwd']);
        }
    }

    if(empty($_FILES['profile-pic']["error"] == 0)) {
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

// user login
if('login' == $action) {
    if($email && $password) {
    
        $query = "SELECT id, password FROM users WHERE email = '{$email}'";
        $result = mysqli_query($conn, $query);
    
        if(mysqli_num_rows($result)> 0) {
            $data = mysqli_fetch_assoc($result);
            $id = $data['id'];
            $_password = $data['password'];
            if($password == $_password) {
                header("location:dashboard.php");
                die();
            }else {
                $status = 1;
            }
        }else {
            $status = 2;
        }
        header("Location: index.php?status={$status}");
    }
}

// user register 
if('register' == $action) {
    if($name && $email && $password && $profilePic) {
        $targetFile = "./profile-pic/". basename($_FILES['profile-pic']['name']);
        $fileName = basename($_FILES['profile-pic']['name']);
        move_uploaded_file($_FILES['profile-pic']['tmp_name'], $targetFile);
        $query = "INSERT INTO  users(name, email, password, profilepic) VALUES ('{$name}', '{$email}', '{$password}', '{$fileName}')";
        
        mysqli_query($conn, $query);
        if(mysqli_error($conn)) {
            echo mysqli_error($conn);
        }else {
            $status = 4;
        }
        // header("Location: index.php?status={$status}");
    }
}





mysqli_close($conn);

