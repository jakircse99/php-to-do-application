<?php
    include_once "../inc/add_task_function.php";
    

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
<body onload="setDefault()">

    <!-- main section start-->

        <div class="create-task">
            <h3>Add task</h3>
            <?php
                $status = $_GET['status'] ?? 0;
                if($status == 1) {
                    echo "<blockquote>Task added successfully</blockquote>";
                } else if($status == 2) {
                    echo "<blockquote>Something went worng, please try agian!</blockquote>";
                }
                ?>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" onsubmit="return validateFrom()" method="post">
                <label for="task-name">Task name</label>
                <input type="text" name="task-name" id= "task-name" placeholder="Enter your task name" required><br>
                <span><?php echo $taskNameErr ?></span>
                <label for="date">Date</label>
                <input type="date" placeholder="dd-mm-yyyy" min="1997-01-01" max="2030-12-31" name="task-date" id= "date" required><br>
                <span><?php echo $taskDateErr ?></span>
                <input type="submit" value = "Add task" class="btn">
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