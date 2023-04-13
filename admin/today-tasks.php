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
    <title>Today tasks</title>
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
                            $id = $tasks[$i]['id'];
                            ?>
                        <tr>
                            <td><span> <?php echo $tasks[$i]['task_name'] ?> </span></td>
                            <td><span><?php echo $tasks[$i]['status'] ?></span></td>
                            <td><span><?php echo $tasks[$i]['progress'] ?></span></td>
                            <td><p><?php echo $tasks[$i]['task_date'] ?></p></td>
                            <td><?php if($tasks[$i]['status'] != 'done') {
                                ?>
                                <a class="complete-btn" href="today-tasks.php?task=complete&id=<?php echo $id;?>">Complete</a>
                                <?php
                                
                            }else {
                                ?>
                                    <a class="incomplete-btn" href="today-tasks.php?task=incomplete&id=<?php echo $id;?>">Incomplete</a>
                                <?php
                            } ?><a class="edit-btn" href="today-tasks.php?task=edit&id=<?php echo $id;?>"> Edit</a><a class="delete-btn" href="all-tasks.php?task=delete&id=<?php echo $id;?>"> Delete</a></td>
                            </tr>
                            <?php
                        }

                    ?>
                </tbody>

            </table>
    <?php
        
        $tasksAction = $_GET['task'] ?? '';
        $taskId = $_GET['id'] ?? '';
        if($tasksAction == 'edit' && $taskId !='') {
            $taskData = getTaskData($taskId);
            ?>
            <div class="edit-task-popup">
                <form action="" method="post">
                <label for="task-name">Task name</label>
                    <input type="text" name="task-name" id= "task-name" value="<?php echo $taskData['task_name'] ?>" required><br>
                    <span><?php echo $taskNameErr ?></span>
                    <label for="date">Date</label>
                    <input type="date" value="<?php echo $taskData['task_date'] ?>" min="1997-01-01" max="2030-12-31" name="task-date" id= "task-date" required><br>
                    <span><?php echo $taskDateErr ?></span>
                    <label for="progress">Progress</label>
                    <input type="number" id="progress" name="progress" min="0" max="100" value="<?php echo $taskData['progress'] ?>"  required><br>
                    <span><?php echo $progressErr ?></span>
                    <input type="hidden" name="action" value="update">
                    <input type="submit" value = "Update" class="btn">
                </form>
            </div>
            <?php
        }
    ?>

        </div>

    <!-- todays tasks ends-->

    <!-- sidebar starts -->

        <?php include_once "../inc/templates/sidebar.php"; ?>

    <!-- sidebar ends -->


    <!-- custom script link  -->
    <script src="../assets/js/main.js"></script>
</body>
</html>