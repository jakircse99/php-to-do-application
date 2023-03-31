<?php
    include_once "../inc/keep_notes_function.php";
    

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
<body id="body" onload="setDefault()">
    <i class="fa-solid fa-bars menu-bars" id="menu-bars"></i>
    <!-- main section start-->

        <div class="keep-notes">
            <?php
                $status = $_GET['status'] ?? 0;
                if('added' == $status) {
                    echo "<blockquote>Note added successfully</blockquote>";
                }else if('deleted' == $status) {
                    echo "<blockquote>Note deleted successfully</blockquote>";
                }
            
            ?>
            <h3>Notes</h3>
            <?php
                $status = $_GET['status'] ?? 0;
                if($status == 1) {
                    echo "<blockquote>Task added successfully</blockquote>";
                } else if($status == 2) {
                    echo "<blockquote>Something went worng, please try agian!</blockquote>";
                }
                ?>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <input type="text" name="note" id="note" placeholder="Enter your note" required>
                <span><?php echo $noteErr; ?></span>
                <input type="hidden" name="action" value="add-note">
                <input type="submit" value = "Add note" class="add-btn">
            </form>
            <form action="" method="post">
            <table>
                <thead>
                    <tr><strong>Note lists</strong></tr>
                </thead>
                <body>
                    <?php
                        $data = displayNotes($userId);
                        $dataLength = count($data);
                        for($i = 0; $i < $dataLength; $i++) {
                            ?>
                            <tr>
                                <td><input type="checkbox" name="note-ids[]" id="cbox" value="<?php echo $data[$i]['id'] ?>"> <?php echo $data[$i]['note'] ?></td>
                            </tr>
                            <?php
                        }
                    ?>
                </body>
            </table>
            
                <input type="hidden" name="action" value="delete">
                <input type="submit" class="delete-btn" value="Delete">
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