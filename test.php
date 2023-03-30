<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
  <input type="file" name="profile-pic" id="profile-pic">
  <input type="submit" value="Upload">
</form>

    <?php
        if($_POST['submit']) {
            $profilePic = array();
            if($_FILES['profile-pic']['size'] != 0) {
                $profilePic = $_FILES['profile-pic'];
            }
            print_r($profilePic['name']);
        }
    ?>
</body>
</html>