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
            <a class="btn" href="#">Login</a>
            <a class="btn" href="#">Register</a>
        </header>
        <main>
            <!-- login section start -->
            <div class="login-box">
                <h2>Login</h2>
                <form action="">
                    <label for="email">Email:</label>
                    <input type="email" name="email" placeholder="enter email">
                    <label for="password">Password:</label>
                    <input type="password" name="password" placeholder="enter password">
                    <input type="submit" class="login-btn" value="Login">
                    <p>You don't have an account? <a href="#">Register now</a></p>
                </form>
            </div>
        </main>
            <!-- login section end -->


    <!-- custom script link  -->
    <script src="./assets/js/main.js"></script>
</body>
</html>