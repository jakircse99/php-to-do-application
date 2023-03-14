<?php
    session_start();
    include_once "../inc/functions.php";


    $_userId = $_SESSION['id'] ?? 0;

    if(!$_userId) {
        header('location: ../index.php');
        die();
    } 
?>

<aside>
    <div class="profile">
        <img src="../profile-pic/<?php displayProfilePic($_userId) ?>" alt="">
        <h3><?php echo getProfileName($_userId) ?></h3>
    </div>
    <div class="menu">
        <a href="../admin/dashboard.php"><i class="fa-solid fa-gauge-high"></i> Dashboard</a>
        <a href="../admin/add-task.php"><i class="fa-solid fa-plus"></i></i> Add task</a>
        <a href="../admin/today-tasks.php"><i class="fa-solid fa-calendar-day"></i> Today task</a>
        <a href="../admin/all-tasks.php"><i class="fa-solid fa-list-check"></i> All tasks</a>
        <a href="../admin/keep-notes.php"><i class="fa-solid fa-note-sticky"></i> Keep notes</a>
        <a href="../admin/profile.php"><i class="fa-solid fa-user"></i> Profile</a>
        <a href="../admin/logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </div>
</aside>