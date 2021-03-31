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
         public function getProducts($search = "", $category = "", $region = "", $offset = "", $no_of_record_per_page = "") {
            $query = [];
            if ($search) {
                $query[] = " product_title LIKE :search ";
            }
            if ($category) {
                $query[] = " id_product_category = :id_product_category ";
            }
            if ($region) {
                $query[] = " id_product_region = :id_product_region ";
            }
            $limit = isset($offset) && isset($no_of_record_per_page) ? " LIMIT $no_of_record_per_page OFFSET $offset " : "";
            if ($query) {
                $sqlQuery = implode(" AND ", $query);
                $sql = "SELECT * FROM product
                        INNER JOIN category ON product.id_product_category = category.category_id
                        INNER JOIN region ON product.id_product_region = region.region_id
                        INNER JOIN user ON product.id_product_user = user.user_id
                        WHERE $sqlQuery
                        ORDER BY product_id DESC
                        $limit";
                $stmt = $this->conn->prepare($sql);
                if ($search) {
                    $stmt->bindValue(":search", "%$search%");
                }
                if ($category) {
                    $stmt->bindValue(":id_product_category", $category);
                }
                if ($region) {
                    $stmt->bindValue("id_product_region", $region);
                }                
            } else {
                $sql = "SELECT * FROM product
                INNER JOIN category ON product.id_product_category = category.category_id
                INNER JOIN region ON product.id_product_region = region.region_id
                INNER JOIN user ON product.id_product_user = user.user_id
                ORDER BY product_id DESC
                $limit";
                $stmt = $this->conn->prepare($sql);
            }
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

         // get all products matching the search expression, or all products if no search is made
         public function countProducts($search = "", $category = "", $region = "") {
            $query = [];
            if ($search) {
                $query[] = " product_title LIKE :search ";
            }
            if ($category) {
                $query[] = " id_product_category = :id_product_category ";
            }
            if ($region) {
                $query[] = " id_product_region = :id_product_region ";
            }
            if ($query) {
                $sqlQuery = implode(" AND ", $query);
                $sql = "SELECT COUNT(*) FROM product
                        WHERE $sqlQuery";
                $stmt = $this->conn->prepare($sql);
                if ($search) {
                    $stmt->bindValue(":search", "%$search%");
                }
                if ($category) {
                    $stmt->bindValue(":id_product_category", $category);
                }
                if ($region) {
                    $stmt->bindValue("id_product_region", $region);
                }                
            } else {
                $sql = "SELECT COUNT(*) FROM product";
                $stmt = $this->conn->prepare($sql);
            }
            $stmt->execute();

            return $stmt->fetch();
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

        public function getProductsByUserId($id) {
            $sql = "SELECT * FROM product
                    INNER JOIN category ON product.id_product_category = category.category_id
                    INNER JOIN region ON product.id_product_region = region.region_id
                    INNER JOIN user ON product.id_product_user = user.user_id
                    WHERE user.user_id = :user_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":user_id", $id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function createProduct(Product $product) {
            $imgQuery = $product->imageName ? " product_image, " : "";
            $imgValue = $product->imageName ? " :product_image, " : "";
            $sql = "INSERT INTO product (product_title, product_description, $imgQuery product_price, id_product_category, id_product_region, id_product_user)
                    VALUES (:product_title, :product_description, $imgValue :product_price, :id_product_category, :id_product_region, :id_product_user)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":product_title", $product->title);
            $stmt->bindValue(":product_description", $product->description);
            if ($product->imageName) {
                $stmt->bindValue(":product_image", $product->imageName);
            } 
            $stmt->bindValue(":product_price", $product->price);
            $stmt->bindValue(":id_product_category", $product->categoryId);
            $stmt->bindValue(":id_product_region", $product->regionId);
            $stmt->bindValue(":id_product_user", $product->userId);
            $stmt->execute();
        }

        public function updateProduct(Product $product) {
            $user_id = $_SESSION['user']['user_id'] ?? null;
            if (!$user_id) {
                header("Location: /products");
                exit();
            }
            if ($user_id != $product->userId) {
                header("Location: /products/user");
                exit();
            }
            $imgQuery = $product->imageName ? " product_image = :product_image," : "";
            $sql = "UPDATE product
                    SET product_title = :product_title,
                    product_description = :product_description,
                    $imgQuery 
                    product_price = :product_price,
                    id_product_category = :id_product_category,
                    id_product_region = :id_product_region,
                    id_product_user = :id_product_user
                    WHERE product_id = :product_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":product_title", $product->title);
            $stmt->bindValue(":product_description", $product->description);
            if ($product->imageName) {
                $stmt->bindValue(":product_image", $product->imageName);
            } 
            $stmt->bindValue(":product_price", $product->price);
            $stmt->bindValue(":id_product_category", $product->categoryId);
            $stmt->bindValue(":id_product_region", $product->regionId);
            $stmt->bindValue(":id_product_user", $product->userId);
            $stmt->bindValue(":product_id", $product->id);
            $stmt->execute();
        }

        public function deleteProduct($id) {
            if($_SESSION['admin']) {
                $sql = "DELETE FROM product
                        WHERE product_id = :product_id";
            } else {
                $userId = $_SESSION['user']['user_id'] ?? null;
                if(!$userId) {
                    header("Location: /products");
                    exit();
                }
                $sql = "DELETE FROM product
                        WHERE product_id = :product_id
                        AND id_product_user = :id_product_user";
            }            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":product_id", $id);
            if($userId) {
                $stmt->bindValue(":id_product_user", $userId);
            }            
            $stmt->execute();
        }

        public function buyProduct($id) {
            $userId = $_SESSION['user']['user_id'] ?? null;
            if(!$userId) {
                header("Location: /products");
                exit();
            }
            $sql = "DELETE FROM product
                    WHERE product_id = :product_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":product_id", $id);         
            $stmt->execute();
        }
    }