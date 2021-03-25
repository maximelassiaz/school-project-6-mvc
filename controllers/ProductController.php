<?php

    namespace app\controllers;

use app\models\Product;
use app\Router;

    class ProductController {

        public static function index(Router $router) {
            $search = $_GET['search'] ?? "";
            $products = $router->db->getProducts($search);
            $router->renderView('products/index', [
                'products' => $products,
                'search' => $search
            ]);
        }

        public static function create(Router $router) {
            $errors = [];
            $productData = [
                'title' => '',
                'description' => '',
                'image' => '',
                'imageFile' => ''
            ];
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $productData['title'] = $_POST['title'];
                $productData['description'] = $_POST['description'];
                $productData['price'] = (float)$_POST['price'];
                $productData['imageFile'] = $_FILES['imageFile'] ?? null; // can be optional

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

        public static function update() {
            echo "Update page";
        }

        public static function delete() {
            echo "Delete page";
        }
    }