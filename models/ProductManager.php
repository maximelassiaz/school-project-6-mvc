<?php

    namespace app\models;

    use PDO;

    class ProductManager extends Database {

        public static ProductManager $productManager;

        // initialize PDO connexion to dabatase
        public function __construct() {
            $this->conn = new PDO('mysql:host=localhost;dbname=webmarket;charset=utf8', 'root', '');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            self::$productManager = $this;
        }

         // get all products matching the search expression, or all products if no search is made
         public function getProducts($search = "") {
            if ($search) {
                $sql = "SELECT * FROM product
                        INNER JOIN category ON product.id_product_category = category.category_id
                        INNER JOIN region ON product.id_product_region = region.region_id
                        INNER JOIN user ON product.id_product_user = user.user_id
                        WHERE product_title LIKE :search ORDER BY product_id DESC";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(":search", "%$search%", PDO::PARAM_STR);
            } else {
                $sql = "SELECT * FROM product
                INNER JOIN category ON product.id_product_category = category.category_id
                INNER JOIN region ON product.id_product_region = region.region_id
                INNER JOIN user ON product.id_product_user = user.user_id
                ORDER BY product_id DESC";
                $stmt = $this->conn->prepare($sql);
            }
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getProductById($id) {
            $sql = "SELECT * FROM product
                    INNER JOIN category ON product.id_product_category = category.category_id
                    INNER JOIN region ON product.id_product_region = region.region_id
                    INNER JOIN user ON product.id_product_user = user.user_id
                    WHERE product_id = :product_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":product_id", $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        // public function getProductByUserId($id) {
        //     $sql = "SELECT * FROM product
        //             INNER JOIN category ON product.id_product_category = category.category_id
        //             INNER JOIN region ON product.id_product_region = region.region_id
        //             INNER JOIN user ON product.id_product_user = user.user_id
        //             WHERE user.user_id = :user_id";
        //     $stmt = $this->conn->prepare($sql);
        //     $stmt->bindValue(":user_id", $id);
        //     $stmt->execute();
        //     return $stmt->fetch(PDO::FETCH_ASSOC);
        // }

        public function createProduct(Product $product) {
            $sql = "INSERT INTO product (product_title, product_description, product_image, product_price, id_product_category, id_product_region, id_product_user)
                    VALUES (:product_title, :product_description, :product_image, :product_price, :id_product_category, :id_product_region, :id_product_user)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":product_title", $product->title);
            $stmt->bindValue(":product_description", $product->description);
            $stmt->bindValue(":product_image", $product->imageName);
            $stmt->bindValue(":product_price", $product->price);
            $stmt->bindValue(":id_product_category", $product->categoryId);
            $stmt->bindValue(":id_product_region", $product->regionId);
            $stmt->bindValue(":id_product_user", $product->userId);
            $stmt->execute();
        }

        public function updateProduct(Product $product) {
            $sql = "UPDATE product
                    SET product_title = :product_title,
                    product_description = :product_description,
                    product_image = :product_image,
                    product_price = :product_price,
                    id_product_category = :id_product_category,
                    id_product_region = :id_product_region,
                    id_product_user = :id_product_user
                    WHERE product_id = :product_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":product_title", $product->title);
            $stmt->bindValue(":product_description", $product->description);
            $stmt->bindValue(":product_image", $product->imageName);
            $stmt->bindValue(":product_price", $product->price);
            $stmt->bindValue(":id_product_category", $product->categoryId);
            $stmt->bindValue(":id_product_region", $product->regionId);
            $stmt->bindValue(":id_product_user", $product->userId);
            $stmt->bindValue(":product_id", $product->id);
            $stmt->execute();
        }

        public function deleteProduct($id) {
            $sql = "DELETE FROM product
                    WHERE product_id = :product_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":product_id", $id);
            $stmt->execute();
        }

    }