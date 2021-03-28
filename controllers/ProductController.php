<?php

    namespace app\controllers;

    use app\models\Product;
    use app\Router;

    class ProductController {

        public static function home(Router $router) {
            $search = $_GET['search'] ?? "";
            $products = $router->productManager->getProducts($search);
            $regions = $router->regionManager->getRegions();
            $categories = $router->categoryManager->getCategories();
            $router->renderView('products/home', [
                'products' => $products,
                'search' => $search,
                'categories' => $categories,
                'regions' => $regions
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
            $search = $_GET['search'] ?? "";
            $products = $router->productManager->getProducts($search);
            $router->renderView('products/management', [
                'products' => $products,
                'search' => $search
            ]);
        }

        public static function details(Router $router) {
            $id = $_GET['id'] ?? null;
            if (!$id) {
                header("Location: /products");
                exit();
            }
            $product = $router->productManager->getProductById($id);
            $router->renderView('products/details', [
                'product' => $product,
            ]);
        }

        public static function create(Router $router) {
            $id = $_SESSION['user']['user_id'] ?? null;
            if (!$id) {
                header("Location: /products");
                exit();
            }
            $errors = [];
            // TODO : send minimum amount of info, remove name
            $productData = [
                'product_title' => '',
                'product_description' => '',
                'product_image' => '',
                'product_imageFile' => '',
                'product_price' => '',
                'product_category_name' => '',
                'product_category_id' => '',
                'product_region_name' => '',
                'product_region_id' => ''
            ];
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
                'errors' => $errors
            ]);
        }

        public static function update(Router $router) {
            $id = $_GET['id'] ?? null;
            if (!$id) {
                header("Location: /products");
                exit();
            }
            $errors = [];
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
                'errors' => $errors
            ]);
        }

        public static function delete(Router $router) {
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                $id = $_POST['product-id'] ?? null;
                if (!$id) {
                    header("Location: /products");
                    exit();
                }
                $router->productManager->deleteProduct($id);
                header("Location: /products/user?delete=success");
                exit();
            }                 
            $router->renderView('products/delete');
        }
    }