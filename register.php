<?php
    include_once "inc/functions.php";
    include_once "process.php";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- milligram css cdn link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">
    <!-- custom css link -->
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h2>PHP To-Do Application</h2>
            <a class="btn" href="./index.php">Login</a>
            <a class="btn" href="./register.php">Register</a>
        </header>
        <main>
            <!-- register section start -->
            <div class="register-box">
                <h2>Register</h2>
                <?php 
                    if(isset($_GET['status'])) {
                        echo getActionMessage($_GET['status']);
                    }


                ?>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                    <label for="name">Name:</label>
                    <input type="text" name="name" placeholder="Enter your name (Only letters and whitespace)">
                    <span style="color:red"><?php echo $nameErr ?> </span>
                    <label for="email">Email:</label>
                    <input type="text" name="email" placeholder="Enter your email"><br>
                    <span style="color:red"><?php echo $emailErr ?> </span>
                    <label for="password">Password:</label>
                    <input type="password" name="password" placeholder="Enter password"><br>
                    <span style="color:red"><?php echo $passwordErr ?> </span>
                    <label for="confirm-pwd">Confirm Password:</label>
                    <input type="password" name="confirm-pwd" placeholder="Confirm your password"><br>
                    <span style="color:red"><?php echo $confirmPasswordErr ?> </span><br>
                    <label for="profile picture">Profile Picture:</label>
                    <input type="file" name="profile-pic"><span style="font-size:13px; color: red;">Image size must be 300 * 300 px and under 100kb</span><br>
                    <span style="color:red"><?php echo $profilePicErr ?> </span><br>
                    <input type="submit" class="submit-btn" value="register">
                    <input type="hidden" name="action" value="register">
                    <p>Already have an account? <a href="./index.php">Login now</a></p>
                </form>
            </div>
        </main>
            <!-- register section end -->


    <!-- custom script link  -->
    <script src="./assets/js/main.js"></script>
</body>
</html>