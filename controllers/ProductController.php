<?php

    namespace app\controllers;

    use app\models\Product;
    use app\Router;

    class ProductController {

        public static function home(Router $router) {
            $search = $_GET['search'] ?? "";
            $category = $_GET['category'] ?? "";
            $region = $_GET['region'] ?? "";

            // pagination
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            $no_of_records_per_page = 8;
            $offset = ($page - 1) * $no_of_records_per_page;
            $total_rows = $router->productManager->countProducts($search, $category, $region)[0];
            $total_pages = ceil($total_rows / $no_of_records_per_page);
            
            $products = $router->productManager->getProducts($search, $category, $region, $offset, $no_of_records_per_page);
            $categories = $router->categoryManager->getCategories();
            $regions = $router->regionManager->getRegions();
            $router->renderView('products/home', [
                'products' => $products,
                'search' => $search,
                'categories' => $categories,
                'regions' => $regions,
                'page' => $page,
                'total_pages' => $total_pages
            ]);
        }

        public static function user(Router $router) {
            $id = $_SESSION['user']['user_id'] ?? null;
            if (!$id) {
                header("Location: /products");
                exit();
            }
            $products = $router->productManager->getProductsbyUserId($id);
            $router->renderView('products/user', [
                'products' => $products,
            ]);
        }

        public static function management(Router $router) {
            $id = $_SESSION['admin']['admin_id']; 
            if (!$id) {
                header("Location: /products");
                exit();
            }

            $search = $_GET['search'] ?? "";
            $category = $_GET['category'] ?? "";
            $region = $_GET['region'] ?? "";

            // pagination
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            $no_of_records_per_page = 8;
            $offset = ($page - 1) * $no_of_records_per_page;
            $total_rows = $router->productManager->countProducts($search, $category, $region)[0];
            $total_pages = ceil($total_rows / $no_of_records_per_page);

            $products = $router->productManager->getProducts($search, $category, $region, $offset, $no_of_records_per_page);
            $categories = $router->categoryManager->getCategories();
            $regions = $router->regionManager->getRegions();
            $router->renderView('products/management', [
                'products' => $products,
                'search' => $search,
                "categories" => $categories,
                "regions" => $regions,
                'page' => $page,
                'total_pages' => $total_pages
            ]);
        }

        public static function details(Router $router) {
            $id = $_GET['id'] ?? null;
            if (!$id) {
                header("Location: /products");
                exit();
            }
            $product = $router->productManager->getProductById($id);
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                if(!isset($_POST['export-submit'])) {
                    header("Location: /products");
                    exit();
                }
                $router->exportToPdf->export($product);
            }
            $router->renderView('products/details', [
                'product' => $product
            ]);
        }

        public static function contact(Router $router) {
            $idClient = $_SESSION['user']['user_id'] ?? null;
            if (!$idClient) {
                header('Location: /products');
                exit();
            }
            $id = $_GET['id'] ?? null;
            if (!$id) {
                header('Location: /products');
                exit();
            }
            $product = $router->productManager->getProductById($id);
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                $fnameSender = $_SESSION['user']['user_fname'];
                $lnameSender = $_SESSION['user']['user_lname'];
                $emailSender = $_SESSION['user']['user_email'];
                $fnameReceiver = $product['user_fname'];
                $lnameReceiver = $product['user_lname'];
                $emailReceiver = $product['user_email'];
                $subject = $_POST['message-subject'];
                $content = $_POST['message-content'];

                $router->mailing->contact($fnameSender, $lnameSender, $emailSender, $fnameReceiver, $lnameReceiver, $emailReceiver, $subject, $content, $id);
            }
            $router->renderView('products/contact', [
                'product' => $product
            ]);
        }

        public static function create(Router $router) {
            $id = $_SESSION['user']['user_id'] ?? null;
            if (!$id) {
                header("Location: /products");
                exit();
            }
            $errors = [];
            $productData = [
                'product_title' => '',
                'product_description' => '',
                'product_image' => '',
                'product_imageFile' => '',
                'product_price' => '',
                'category_id' => '',
                'region_id' => ''
            ];

            $categories = $router->categoryManager->getCategories();
            $regions = $router->regionManager->getRegions();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $productData['product_title'] = $_POST['product-title'];
                $productData['product_description'] = $_POST['product-description'];                
                $productData['product_imageFile'] = $_FILES['product-image'] ?? null; // can be optional
                $productData['product_price'] = (float)$_POST['product-price'];
                $productData['category_id'] = (int)$_POST['product-category'];
                $productData['region_id'] = (int)$_POST['product-region'];
                $productData['user_id'] = (int)$id;

                $product = new Product();
                $product->load($productData);
                $errors = $product->save();
                if (empty($errors)) {
                    header('Location: /products');
                    exit();
                }    

            }
            $router->renderView('products/create', [
                'product' => $productData,
                'errors' => $errors,
                'regions' => $regions,
                'categories' => $categories
            ]);
        }

        public static function update(Router $router) {
            $id = $_GET['id'] ?? null;
            if (!$id) {
                header("Location: /products");
                exit();
            }
            $errors = [];
            $categories = $router->categoryManager->getCategories();
            $regions = $router->regionManager->getRegions();
            $productData = $router->productManager->getProductbyId($id);
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                $productData['product_title'] = $_POST['product-title'];
                $productData['product_description'] = $_POST['product-description'];
                $productData['product_price'] = (float)$_POST['product-price'];
                $productData['product_imageFile'] = $_FILES['product-imageFile'] ?? null; // can be optional

                $product = new Product();
                $product->load($productData);
                $errors = $product->save();
                if (empty($errors)) {
                    header('Location: /products/user?update=success');
                    exit();
                }  
            }
            $router->renderView('products/update', [
                'product' => $productData,
                'errors' => $errors,
                'regions' => $regions,
                'categories' => $categories
            ]);
        }

        public static function buy(Router $router) {
            $idClient = $_SESSION['user']['user_id'] ?? null;
            if (!$idClient) {
                header('Location: /products');
                exit();
            }
            $id = $_GET['id'] ?? null;
            if (!$id) {
                header('Location: /products');
                exit();
            }
            $product = $router->productManager->getProductById($id);
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                $fnameClient = $_SESSION['user']['user_fname'];
                $lnameClient = $_SESSION['user']['user_lname'];
                $emailClient = $_SESSION['user']['user_email'];
                $usernameClient = $_SESSION['user']['user_username'];
                $fnameSeller = $product['user_fname'];
                $lnameSeller = $product['user_lname'];
                $emailSeller = $product['user_email'];
                $usernameSeller = $product['user_username'];
                $router->mailing->buySeller($fnameSeller, $lnameSeller, $emailSeller, $usernameSeller, $usernameClient, $product);
                $router->mailing->buyClient($fnameClient, $lnameClient, $emailClient, $usernameClient, $usernameSeller, $product);
                $router->productManager->buyProduct($id);
                header("Location: /products");
                exit();
            }
            $router->renderView('products/buy', [
                'product' => $product
            ]);
        }

        public static function delete(Router $router) {
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                $id = $_POST['product-id'] ?? null;
                if (!$id) {
                    header("Location: /products");
                    exit();
                }
                $product = $router->productManager->getProductById($id);
                $pathDelete = "product_image/" . $product['product_image'];
                unlink($pathDelete);
                $router->productManager->deleteProduct($id);
                header("Location: /products/user?delete=success");
                exit();
            }                 
            $router->renderView('products/delete');
        }
    }