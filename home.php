<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <!-- $_SESSION['user_credentials'] = [
        'user_id' => $user['user_id'],
        'is_admin' => $user['is_admin'],
        'is_staff' => $user['is_staff']
    ]; -->
   <h1>Welcome <?php if($_SESSION['user_credentials']['is_admin'] == 1) echo "Admin";
   else if($_SESSION['user_credentials']['is_staff'] == 1 && $_SESSION['user_credentials']['is_admin'] == 0) echo "Staff";
   else echo "Client" ?>
   </h1> 
   
   <?php
   echo "<a>View</a><br>";
    if($_SESSION['user_credentials']['is_staff'] == 1 || $_SESSION['user_credentials']['is_admin'] == 1){
        echo "<a>Add</a><br><a>Edit</a><br>";
        if($_SESSION['user_credentials']['is_admin'] == 1){
            echo "<a>Delete</a><br>";
        }
    }
   ?>

   <br><a href="logout.php">logout</a>
</body>
</html>