<?php
    session_start();
    require_once 'user.class.php';
    require_once 'clean.php';

    $objUser = new User;

    $username = $password = $confirm_password = $is_admin = $is_staff ='';
    $usernameErr = $passwordErr = $confirm_passwordErr = '';
    $allinputsfield = true;

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = isset($_POST['username']) ? clean_input($_POST['username']) : '';
        $password = isset($_POST['password']) ? clean_input($_POST['password']) : '';
        $confirm_password = isset($_POST['confirm_password']) ? clean_input($_POST['confirm_password']) : '';
        $is_staff = isset($_POST['is_staff']) ? clean_input($_POST['is_staff']) : 0;
        $is_admin = isset($_POST['is_admin']) ? clean_input($_POST['is_admin']) : 0;

        if(empty($username)){
            $usernameErr = ' Username is required!';
            $allinputsfield = false;
        }
        if(empty($password)){
            $passwordErr = ' Password is required!';
            $allinputsfield = false;
        }
        if(empty($confirm_password)){
            $confirm_passwordErr = ' Confirm password is required!';
            $allinputsfield = false;
        } else if($confirm_password != $password){
            $confirm_passwordErr = ' Confirm password not match!';
            $allinputsfield = false;
        }

        if($allinputsfield){
            if($objUser->record_exist($username) == true){
                $usernameErr = ' Username exist!';
            } else {
                $objUser->create_account($username, $password, $is_admin, $is_staff);
            }
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Signup</title>
        <style>
            
        </style>
    </head>
    <body>
        <section>
            <div class="div_form">
                <h1>SignUp</h1>
                <form action="" method="post">
                    * Are required fields.
                    <div class="input">
                        Username <span class="required">* <?= $usernameErr; ?></span><br>
                        <input type="text" name="username" id="username" value="<?= $username;?>">
                    </div>
                    <div class="input">
                        Password <span class="required">* <?= $passwordErr ?></span><br>
                        <input type="password" name="password" id="password">
                    </div>
                    <div class="input">
                        Confirm Password <span class="required">* <?= $confirm_passwordErr ?></span><br>
                        <input type="password" name="confirm_password" id="confirm_password">
                    </div>
                    <div class="input">
                        Role <br>
                        <input type="checkbox" name="is_admin" id="is_admin" value="1">Admin <br>
                        <input type="checkbox" name="is_staff" id="is_staff" value="1">Staff<br>
                    </div>
                    <p>already have an account? <a href="login.php">LogIn</a></p>
                    <input type="submit" value="Submit">
                </form>
            </div>
        </section>
        <script>
            const adminCheckbox = document.querySelector('#is_admin');
            const staffCheckbox = document.querySelector('#is_staff');

            adminCheckbox.addEventListener('change', () => {
            if (adminCheckbox.checked) {
                staffCheckbox.checked = true;
            }
            });

            staffCheckbox.addEventListener('change', () => {
            if (adminCheckbox.checked) {
                staffCheckbox.checked = true;
            }
            });
        </script>
    </body>
    </html>