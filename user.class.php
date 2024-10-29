<?php
require_once 'database.class.php';
class User {
    private $conn;

    function __construct(){
        $db = new Database;
        $this->conn = $db->connect();
    }

    function create_account($username, $password, $is_admin, $is_staff){
        $sql = "INSERT INTO user(username, password, is_admin, is_staff) VALUES(:username, :password, :is_admin, :is_staff);";
        $query = $this->conn->prepare($sql);

        $query->bindParam(":username", $username);
        $query->bindParam(":password", $password);
        $query->bindParam(":is_admin", $is_admin);
        $query->bindParam(":is_staff", $is_staff);

        if($query->execute()){
            $_SESSION['user_credentials'] = [
                'user_id' => $this->conn->lastInsertId(),
                'is_admin' => $is_admin,
                'is_staff' => $is_staff
            ];
            header('Location: home.php');
        } else {
            return false;
        }
        }

    function login($username, $password){
        $sql = "SELECT * FROM user WHERE username = :username AND password = :password LIMIT 1;";
        $query = $this->conn->prepare($sql);

        $query->bindParam(":username", $username);
        $query->bindParam(":password", $password);

        $query->execute();

        $user = $query->fetch();

        if($user){
            $_SESSION['user_credentials'] = [
                'user_id' => $user['user_id'],
                'is_admin' => $user['is_admin'],
                'is_staff' => $user['is_staff']
            ];
            header('Location: home.php');
        } else {
            $_SESSION['incorrect_credentials'] = ' Incorrect username or password!';
        }
    }

    function record_exist($username){
            $sql = 'SELECT COUNT(*) FROM user WHERE username = :username LIMIT 1';
            $query = $this->conn->prepare($sql);

            $query->bindParam(":username", $username);

            $query->execute();
            $count = $query->fetchColumn();

            return $count > 0;
        }
    }
?>