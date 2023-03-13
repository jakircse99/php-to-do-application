<?php
    include_once "inc/functions.php";
    include_once "process.php";

    $_userId = $_SESSION['id'] ?? 0;

    if($_userId) {
        header('location: admin/dashboard.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP To-Do Application</title>
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
            <!-- login section start -->
            <div class="login-box">
                <h2>Login</h2>
                <?php 
                    if(isset($_GET['status'])) {
                        echo getActionMessage($_GET['status']);
                    }
                ?>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <label for="email">Email:</label>
                    <input type="text" name="email" placeholder="Enter email"><br>
                    <span style="color:red"><?php echo $emailErr ?> </span>
                    <label for="password">Password:</label>
                    <input type="password" name="password" placeholder="Enter password"><br>
                    <span style="color:red"><?php echo $passwordErr ?> </span><br>
                    <input type="submit" class="submit-btn" value="Login">
                    <input type="hidden" name="action" value="login">
                    <p>You don't have an account? <a href="./register.php">Register now</a></p>
                </form>
            </div>
        </main>
            <!-- login section end -->


    <!-- custom script link  -->
    <script src="./assets/js/main.js"></script>
</body>
</html>