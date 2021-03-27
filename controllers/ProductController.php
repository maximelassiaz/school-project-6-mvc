<?php

    namespace app\controllers;

    use app\models\Product;
    use app\Router;

    class ProductController {

        public static function home(Router $router) {
            $search = $_GET['search'] ?? "";
            $products = $router->productManager->getProducts($search);
            $router->renderView('products/home', [
                'products' => $products,
                'search' => $search
            ]);
        }

        // public static function user(Router $router) {
        //     $products = $router->db->getProductsbyUserId();
        //     $router->renderView('products/user', [
        //         'products' => $products,
        //     ]);
        // }

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
                $productData['product_category_id'] = (int)$_POST['product-category'];
                $productData['product_region_id'] = (int)$_POST['product-region'];
                // TODO : modify for users id to be inserted (session ?)
                $productData['product_user_id'] = 1;

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
            }
            $router->renderView('products/update', [
                'product' => $productData,
                'errors' => $errors
            ]);
        }

        public static function delete(Router $router) {
            $id = $_POST['product_id'] ?? null;
            if (!$id) {
                header("Location: /products");
                exit();
            }
            $router->productManager->deleteProduct($id);
            header("Location: /products");
            exit();
        }
    }