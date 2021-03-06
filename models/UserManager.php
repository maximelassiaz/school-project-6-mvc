<?php

    namespace app\models;

    use PDO;

    class UserManager extends Database {

        public static UserManager $userManager;

        // initialize PDO connexion to dabatase
        public function __construct() {
            $this->conn = new PDO('mysql:host=localhost;dbname=webmarket;charset=utf8', 'root', '');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            self::$userManager = $this;
        }

        // get all users matching the search expression, or all users if no search is made
        public function getUsers($search = "") {
            if ($search) {
                $sql = "SELECT * FROM user
                        WHERE user_fname LIKE :search 
                            OR user_lname LIKE :search
                        ORDER BY user_id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(":search", "%$search%", PDO::PARAM_STR);
            } else {
                $sql = "SELECT * FROM user
                ORDER BY user_id DESC";
                $stmt = $this->conn->prepare($sql);
            }
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // get user by her id
        public function getUserById($id) {
            $sql = "SELECT * FROM user
                    WHERE user_id = :user_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":user_id", $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function loginUser(User $user) {
            $sql = "SELECT * FROM user
                    WHERE user_email = :user_email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":user_email", $user->email);
            $stmt->execute();
            $count = $stmt->rowCount();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($count < 1) {
                header("Location: /user/login?error=login");
                exit();
            }
            if (!password_verify($user->password,$row['user_password'])){
                header("Location: /user/login?error=login");
                exit();
            }
            return $row; 
        }

        public function createUser(User $user) {
            $sql = "INSERT INTO user (user_fname, user_lname, user_email, user_password, user_username)
                    VALUES (:user_fname, :user_lname, :user_email, :user_password, :user_username)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":user_fname", $user->fname);
            $stmt->bindValue(":user_lname", $user->lname);
            $stmt->bindValue(":user_email", $user->email);
            $stmt->bindValue(":user_password", password_hash($user->password, PASSWORD_DEFAULT));
            $stmt->bindValue(":user_username", $user->username);
            $stmt->execute();
        }

        public function updateUser(User $user) {
            $sql = "UPDATE user
                    SET user_fname = :user_fname,
                    user_lname = :user_lname,
                    user_email = :user_email,
                    user_password = :user_password,
                    user_username = :user_username
                    WHERE user_id = :user_id";
           $stmt = $this->conn->prepare($sql);
           $stmt->bindValue(":user_fname", $user->fname);
           $stmt->bindValue(":user_lname", $user->lname);
           $stmt->bindValue(":user_email", $user->email);
           $stmt->bindValue(":user_password", password_hash($user->password, PASSWORD_DEFAULT));
           $stmt->bindValue(":user_username", $user->username);
           $stmt->bindValue(":user_id", $user->id);
           $stmt->execute();
        }

        public function deleteUser($id) {
            $sql = "DELETE FROM product
                    WHERE id_product_user = :id_product_user";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":id_product_user", $id);
            $stmt->execute();
            $sql = "DELETE FROM user
                    WHERE user_id = :user_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":user_id", $id);
            $stmt->execute();
        }
    }