<?php
    session_start();
    include_once "../inc/functions.php";


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
    <title>PHP To-Do Application</title>
    <!-- milligram css cdn link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">
    <!-- font-awsome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <!-- custom css link -->
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    
    <!-- header starts -->

        <header>
            <div class="greetings">
                <p><i class="fa-solid fa-hands-clapping"></i> <?php greeting() ?>, <?php echo getProfileName($_userId); ?>!</p>
            </div>
            <div class="date">
                <p><?php echo displayDate() ?></p>
            </div>
        </header>

    <!-- header ends -->

    <!-- main section start-->

        <main>
            <table>
                <thead>
                    <tr>
                        <th>Task name</th>
                        <th>Status</th>
                        <th>Progress</th>
                    </tr>
                </thead>

                   <tbody class="today">
                        <tr>
                            <td><span class="tasks-list-title"><i class="fa-solid fa-chevron-down"></i> Today</span></td>
                        </tr>
                        
                        <?php 
                            $tasks = getTodayTasks($_userId);
                            $taskLenght = count($tasks);
                            for($i = 0; $i < $taskLenght; $i++) {
                                ?>
                            <tr>
                                <td><span> <?php echo $tasks[$i]['task_name'] ?> </span></td>
                                <td><span><?php echo $tasks[$i]['status'] ?></span></td>
                                <td><span><?php echo $tasks[$i]['progress'] ?></span></td>
                                </tr>
                                <?php
                            }

                        ?>
                        
                   </tbody>
                   <tbody class="tomorrow">
                        <tr>
                            <td><span class="tasks-list-title"><i class="fa-solid fa-chevron-down"></i> Tomorrow</span></td>
                        </tr>
                        <?php 
                            $tasks = getTomorrowTasks($_userId);
                            $taskLenght = count($tasks);
                            for($i = 0; $i < $taskLenght; $i++) {
                                ?>
                            <tr>
                                <td><span> <?php echo $tasks[$i]['task_name'] ?> </span></td>
                                <td><span><?php echo $tasks[$i]['status'] ?></span></td>
                                <td><span><?php echo $tasks[$i]['progress'] ?></span></td>
                                </tr>
                                <?php
                            }

                        ?>
                   </tbody>
            </table>
        </main>

    <!-- main section end-->

    <!-- sidebar starts -->

        <?php include_once "../inc/templates/sidebar.php"; ?>

    <!-- sidebar ends -->


    <!-- custom script link  -->
    <script src="./assets/js/main.js"></script>
</body>
</html>