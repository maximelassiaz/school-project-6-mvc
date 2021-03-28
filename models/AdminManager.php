<?php

    namespace app\models;

    use PDO;

    class AdminManager extends Database {

        public static AdminManager $adminManager;

        // initialize PDO connexion to dabatase
        public function __construct() {
            $this->conn = new PDO('mysql:host=localhost;dbname=webmarket;charset=utf8', 'root', '');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            self::$adminManager = $this;
        }

        // get all admins matching the search expression, or all admins if no search is made
        public function getAdmins($search = "") {
            if ($search) {
                $sql = "SELECT * FROM admin
                        WHERE admin_username LIKE :search
                        ORDER BY admin_id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(":search", "%$search%", PDO::PARAM_STR);
            } else {
                $sql = "SELECT * FROM admin
                ORDER BY admin_id DESC";
                $stmt = $this->conn->prepare($sql);
            }
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // get admin by her id
        public function getAdminById($id) {
            $sql = "SELECT * FROM admin
                    WHERE admin_id = :admin_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":admin_id", $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function loginAdmin(Admin $admin) {
            $sql = "SELECT * FROM admin
                    WHERE admin_email = :admin_email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":admin_email", $admin->email);
            $stmt->execute();
            $count = $stmt->rowCount();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($count < 1) {
                header("Location: /admin/login?error=login");
                exit();
            }
            if (!password_verify($admin->password,$row['admin_password'])){
                header("Location: /admin/login?error=login");
                exit();
            }
            return $row; 
        }

        public function createAdmin(Admin $admin) {
            $sql = "INSERT INTO admin (admin_email, admin_password, admin_username)
                    VALUES (:admin_email, :admin_password, :admin_username)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":admin_email", $admin->email);
            $stmt->bindValue(":admin_password", password_hash($admin->password, PASSWORD_DEFAULT));
            $stmt->bindValue(":admin_username", $admin->username);
            $stmt->execute();
        }

        public function updateAdmin(Admin $admin) {
            $sql = "UPDATE admin
                    SET admin_email = :admin_email,
                    admin_password = :admin_password,
                    admin_username = :admin_username
                    WHERE admin_id = :admin_id";
           $stmt = $this->conn->prepare($sql);
           $stmt->bindValue(":admin_email", $admin->email);
           $stmt->bindValue(":admin_password", password_hash($admin->password, PASSWORD_DEFAULT));
           $stmt->bindValue(":admin_username", $admin->username);
           $stmt->bindValue(":admin_id", $admin->id);
           $stmt->execute();
        }

        public function deleteAdmin($id) {
            $sql = "DELETE FROM admin
                    WHERE admin_id = :admin_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":admin_id", $id);
            $stmt->execute();
        }
    }