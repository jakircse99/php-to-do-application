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
<body id="body">
    <i class="fa-solid fa-bars menu-bars" id="menu-bars"></i>

    <!-- all tasks start-->

        <div class="tasks-info">
        <?php
        
        $status = $_GET['status'] ?? '';
        if($status == 'update') {
            echo "<blockquote style='color: green;'> Task updated successfully </blockquote>";
        }else if($status == 'delete') {
            echo "<blockquote style='color: green;'> Task deleted successfully </blockquote>";
        }
        ?>
            <h3>All tasks</h3>
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
                <tbody class="incomplete-tasks">
                    <tr>
                        <td><span class="table-heading">Incomplete tasks</span></td>
                    </tr>

                    <?php
                        $tasks = getIncompleteTasks($_userId);
                        $tasksLength = count($tasks);
                        for($i = 0; $i < $tasksLength; $i++) {
                            $id= $tasks[$i]['id'];
                            ?>
                         <tr>
                            <td><i class="fa-regular fa-circle"></i> <?php echo $tasks[$i]['task_name'];?></td>
                            <td><span><?php echo $tasks[$i]['status'];?></span></td>
                            <td><span><?php echo $tasks[$i]['progress'];?></span></td>
                            <td><?php echo $tasks[$i]['task_date'];?></td>
                            <td><?php if($tasks[$i]['status'] != 'done') {
                                ?>
                                <a class="complete-btn" href="all-tasks.php?task=complete&id=<?php echo $id;?>">Complete</a>
                                <?php
                                
                            }else {
                                ?>
                                    <a class="incomplete-btn" href="all-tasks.php?task=incomplete">Incomplete</a>
                                <?php
                            } ?><a class="edit-btn" href="all-tasks.php?task=edit&id=<?php echo $id;?>"> Edit</a><a class="delete-btn" href="all-tasks.php?task=delete&id=<?php echo $id;?>"> Delete</a></td>
                        </tr>
                            <?php
                        }
                    ?>
                </tbody>

                <tbody class="complete-tasks">
                    <tr>
                        <td><span class="table-heading">Complete tasks</span></td>
                    </tr>
                    <?php
                        $tasks = getCompleteTasks($_userId);
                        $tasksLength = count($tasks);
                        for($i = 0; $i < $tasksLength; $i++) {
                            $id = $tasks[$i]['id'];
                            ?>
                         <tr>
                            <td><i class="fa-solid fa-circle-check"></i></i> <?php echo $tasks[$i]['task_name'];?></td>
                            <td><span><?php echo $tasks[$i]['status'];?></span></td>
                            <td><span><?php echo $tasks[$i]['progress'];?></span></td>
                            <td><?php echo $tasks[$i]['task_date'];?></td>
                            <td><?php if($tasks[$i]['status'] != 'done') {
                                ?>
                                <a class="complete-btn" href="#">Complete</a>
                                <?php
                                
                            }else {
                                ?>
                                    <a class="incomplete-btn" href="all-tasks.php?task=incomplete&id=<?php echo $id;?>">Incomplete</a>
                                <?php
                            } ?><a class="edit-btn" href="all-tasks.php?task=edit&id=<?php echo $id;?>"> Edit</a><a class="delete-btn" href="all-tasks.php?task=delete&id=<?php echo $id;?>"> Delete</a></td>
                        </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>

        </div>

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



    <!-- all tasks ends-->

    <!-- sidebar starts -->

        <?php include_once "../inc/templates/sidebar.php"; ?>

    <!-- sidebar ends -->


    <!-- custom script link  -->
    <script src="../assets/js/main.js"></script>
</body>
</html>