<?php

    namespace app\models;

    use PDO;

    class CategoryManager extends Database {

        public static CategoryManager $categoryManager;

        // initialize PDO connexion to dabatase
        public function __construct() {
            $this->conn = new PDO('mysql:host=localhost;dbname=webmarket;charset=utf8', 'root', '');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            self::$categoryManager = $this;
        }

         // get all categories matching the search expression, or all categories if no search is made
         public function getCategories() {
            $sql = "SELECT * FROM category
            ORDER BY category_name";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getCategoryById($id) {
            $sql = "SELECT * FROM category
                    WHERE category_id = :category_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":category_id", $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function createCategory(Category $category) {
            $sql = "INSERT INTO category (category_name)
                    VALUES (:category_name)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":category_name", $category->name);
            $stmt->execute();
        }

        public function updateCategory(Category $category) {
            $user_id = $_SESSION['admin']['admin_id'] ?? null;
            if (!$user_id) {
                header("Location: /products");
                exit();
            }
            $sql = "UPDATE category
                    SET category_name = :category_name
                    WHERE category_id = :category_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":category_name", $category->name);
            $stmt->bindValue(":category_id", $category->id);
            $stmt->execute();
        }

        public function deleteCategory($id) {
            if(!$_SESSION['admin']) {
                header("Location: /products");
                exit();
            }
            $sql = "UPDATE product
                    SET id_product_category = :id_product_category_default
                    WHERE id_product_category = :id_product_category";                       
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":id_product_category_default", 6); // set equal to NA 
            $stmt->bindValue(":id_product_category", $id);       
            $stmt->execute();
            $sql = "DELETE FROM category
                    WHERE category_id = :category_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":category_id", $id);    
            $stmt->execute();
        }
    }