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
    

    <!-- todays tasks start-->

    <div class="tasks-info">
            <h3>Today's tasks</h3>
            <table>
                <thead>
                    <tr>
                        <th>Task name</th>
                        <th>Status</th>
                        <th>Progress</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                        $tasks = getTodayTasks($_userId);
                        $taskLenght = count($tasks);
                        for($i = 0; $i < $taskLenght; $i++) {
                            ?>
                        <tr>
                            <td><span> <?php echo $tasks[$i]['task_name'] ?> </span></td>
                            <td><span><?php echo $tasks[$i]['status'] ?></span></td>
                            <td><span><?php echo $tasks[$i]['progress'] ?></span></td>
                            <td><?php echo $tasks[$i]['task_date'] ?></td>
                            <td><?php if($tasks[$i]['status'] != 'done') {
                                ?>
                                <a class="complete-btn" href="#">Complete</a>
                                <?php
                                
                            }else {
                                ?>
                                    <a class="incomplete-btn" href="#">Incomplete</a>
                                <?php
                            } ?><a class="edit-btn" href="#"> Edit</a><a class="delete-btn" href="#"> Delete</a></td>
                            </tr>
                            <?php
                        }

                    ?>
                </tbody>

            </table>

        </div>

    <!-- todays tasks ends-->

    <!-- sidebar starts -->

        <?php include_once "../inc/templates/sidebar.php"; ?>

    <!-- sidebar ends -->


    <!-- custom script link  -->
    <script src="./assets/js/main.js"></script>
</body>
</html>