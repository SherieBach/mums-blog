<?php
include '../includes/functions.php';

class User {
        
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    //method to insert user data into db
    public function register($username, $password, $email) {

        if(strlen($username) < 4 || ctype_space($username)){
            header('Location:../views/register_user.php');
            exit();
        } 
        

                if (!empty($username) && !empty($email)) {

            $username = trim(htmlspecialchars($username));
            $email = (htmlspecialchars($email));
        } else {
            
                header('Location:/register_view.php');
                exit();
            
        }
        

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $statement = $this->pdo->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, 
        :email)");
        $statement->execute(
            [
                ":username" => $username,
                ":password" => $hashed_password,
                ":email" => $email
            ]
        );
        header('Location: ../index.php');
    }
}
