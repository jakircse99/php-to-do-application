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
                <p><i class="fa-solid fa-hands-clapping"></i> Good morning, Jhon Doe!</p>
            </div>
            <div class="date">
                <p>Friday, 24th February, 2023</p>
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
                        <tr>
                            <td><span><i class="fa-solid fa-circle-check"></i> UI/ UX Research </span></td>
                            <td><span>done</span></td>
                            <td><span>100</span></td>
                        </tr>
                        <tr>
                            <td><span><i class="fa-solid fa-circle-check"></i> UI/ UX Research </span></td>
                            <td><span>done</span></td>
                            <td><span>100</span></td>
                        </tr>
                        <tr>
                            <td><span><i class="fa-solid fa-circle-check"></i> UI/ UX Research </span></td>
                            <td><span>done</span></td>
                            <td><span>100</span></td>
                        </tr>
                        <tr>
                            <td><span><i class="fa-solid fa-circle-check"></i> UI/ UX Research </span></td>
                            <td><span>done</span></td>
                            <td><span>100</span></td>
                        </tr>
                        <tr>
                            <td><span><i class="fa-solid fa-circle-check"></i> UI/ UX Research </span></td>
                            <td><span>done</span></td>
                            <td><span>100</span></td>
                        </tr>
                   </tbody>
                   <tbody class="tomorrow">
                        <tr>
                            <td><span class="tasks-list-title"><i class="fa-solid fa-chevron-down"></i> Tomorrow</span></td>
                        </tr>
                        <tr>
                            <td><span><i class="fa-regular fa-circle"></i> Learn data structure </span></td>
                            <td><span>To-do</span></td>
                            <td><span>0</span></td>
                        </tr>
                        <tr>
                            <td><span><i class="fa-regular fa-circle"></i> Learn data structure </span></td>
                            <td><span>To-do</span></td>
                            <td><span>0</span></td>
                        </tr>
                        <tr>
                            <td><span><i class="fa-regular fa-circle"></i> Learn data structure </span></td>
                            <td><span>To-do</span></td>
                            <td><span>0</span></td>
                        </tr>
                        <tr>
                            <td><span><i class="fa-regular fa-circle"></i> Learn data structure </span></td>
                            <td><span>To-do</span></td>
                            <td><span>0</span></td>
                        </tr>
                        <tr>
                            <td><span><i class="fa-regular fa-circle"></i> Learn data structure </span></td>
                            <td><span>To-do</span></td>
                            <td><span>0</span></td>
                        </tr>
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