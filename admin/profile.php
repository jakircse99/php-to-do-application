<?php
    session_start();
    include_once "../inc/profile-function.php";

    $_userId = $_SESSION['id'] ?? 0;
    if(!$_userId) {
        header('location: ../index.php');
        die();
    }
    

    // else {
    //     $currentTime = time();

    //     if($currentTime > $_SESSION['expire']) {
    //         $_SESSION['id'] = 0;
    //         session_destroy();
    //         header("location: ../index.php");
    //     }
    // }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new task</title>
    <!-- milligram css cdn link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">
    <!-- font-awsome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <!-- custom css link -->
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body id="body">
    <i class="fa-solid fa-bars menu-bars" id="menu-bars"></i>
    <!-- main section start-->
        <?php 
            $data = profileData($_userId);
            $status = $_GET['status']?? 0;
            if('update_success' == $status) {
                echo "<blockquote>Profile update successfully</blockquote>";
            }
           
        ?>
        <div class="profile">
            <img src="../profile-pic/<?php echo $data['profilepic'] ?>" alt="">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                <label for="profile-pic">Change profile</label>
                <input type="file" name="profile-pic" id="profile-pic">
                <span><?php echo $profilePicErr; ?></span>
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="<?php echo $data['name'] ?>">
                <span><?php echo $nameErr; ?></span>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo $data['email'] ?>">
                <span><?php echo $emailErr; ?></span>
                <label for="old-pass">Old password:</label>
                <input type="password" name="old-pass" id="old-pass">
                <span><?php echo $oldPasswordErr; ?></span>
                <label for="new-pass">New password:</label>
                <input type="password" name="new-pass" id="new-pass">
                <span><?php echo $newPasswordErr; ?></span><br>
                <input type="hidden" name="action" value="profile-update">
                <input type="submit" value="Update" class="add-btn">
            </form>
        </div>


    <!-- main section end-->

    <!-- sidebar starts -->

        <?php include_once "../inc/templates/sidebar.php"; ?>

    <!-- sidebar ends -->


    <!-- custom script link  -->
    <script src="../assets/js/main.js"></script>
</body>
</html>