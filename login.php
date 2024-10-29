<?php
session_start();
require_once 'user.class.php';
require_once 'clean.php';

$objUser = new User;

$username = $password = '';
$usernameErr = $passwordErr = $incorrect_credentials = '';
$allinputsfield = true;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = isset($_POST['username']) ? clean_input($_POST['username']) : '' ;
    $password = isset($_POST['password']) ? clean_input($_POST['password']) : '' ;
    $record_exist_function = $objUser->record_exist($username);

    if(empty($username)){
        $usernameErr = ' Username is required!';
        $allinputsfield = false;
    }

    if(empty($password)){
        $passwordErr = ' Password required!';
        $allinputsfield = false;
    }

    if($allinputsfield){
        $objUser->login($username, $password);
        $incorrect_credentials = $_SESSION['incorrect_credentials'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
    
</head>
<body>
    <section class="div_form">
        <h1>Login</h1>
            <form method="post">
                <div class="f_child">
                    <span class="required"><?= $incorrect_credentials; ?></span>
                    <div>
                        Username <span class="required">* <?= $usernameErr; ?></span><br>
                        <input type="text" name="username" id="username">
                    </div>
                    <div>
                        Password <span class="required">* <?= $passwordErr; ?></span><br>
                        <input type="password" name="password" id="password">
                    </div>
                    <div>
                        <p>don't have an account yet? <a href="signup.php">Sign Up!</a></p>
                    </div>
                    <input type="submit" value="Submit">
            </form>
        </div>
    </section>
</body>
</html>