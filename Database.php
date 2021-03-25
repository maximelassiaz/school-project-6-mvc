<?php

    namespace app;

    use PDO;

    class Database {

        public \PDO $conn;

        // initialize PDO connexion to dabatase
        public function __construct() {
            $this->conn = new PDO('mysql:host=localhost;dbname=webmarket;charset=utf8', 'root', '');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        // get all products matching the search expression, or all products if no search is made
        public function getProducts($search = "") {
            if ($search) {
                $stmt = $this->conn->prepare('SELECT * FROM product WHERE product_title LIKE :search ORDER BY product_id DESC');
                $stmt->bindValue(":search", "%$search%", PDO::PARAM_STR);
            } else {
                $stmt = $this->conn->prepare('SELECT * FROM product ORDER BY product_id DESC');
            }
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function createProduct(Product $product) {
            $stmt = $this->conn->prepare("INSERT INTO product ()");
        }
    }