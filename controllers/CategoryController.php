<?php

    namespace app\controllers;

    use app\models\Category;
    use app\Router;

    class CategoryController {

        public static function management(Router $router) {
            $id = $_SESSION['admin']['admin_id'] ?? null;
            if (!$id) {
                header("Location: /products");
                exit();
            }
            $search = $_GET['search'] ?? "";
            $categories = $router->categoryManager->getCategories($search);
            $router->renderView('categories/management', [
                'categories' => $categories,
                'search' => $search
            ]);
        }

        public static function create(Router $router) {
            $id = $_SESSION['admin']['admin_id'] ?? null;
            if (!$id) {
                header("Location: /products");
                exit();
            }
            $errors = [];
            $categoryData = [
                'category_name' => ''
            ];
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $categoryData['category_name'] = $_POST['category-name'];
                $category = new Category();
                $category->load($categoryData);
                $errors = $category->save();
                if (empty($errors)) {
                    header('Location: /category/management');
                    exit();
                }    
            }
            $router->renderView('categories/create', [
                'category' => $categoryData,
                'errors' => $errors
            ]);
        }

        public static function update(Router $router) {
            $idAdmin = $_SESSION['admin']['admin_id'] ?? null;
            if (!$idAdmin) {
                header("Location: /products");
                exit();
            }
            $id = $_GET['id'] ?? null;
            if (!$id) {
                header("Location: /products");
                exit();
            }
            $errors = [];
            $categoryData = $router->categoryManager->getCategorybyId($id);
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                $categoryData['category_name'] = $_POST['category-name'];
                $category = new Category();
                $category->load($categoryData);
                $errors = $category->save();
                if (empty($errors)) {
                    header('Location: /category/management');
                    exit();
                }  
            }
            $router->renderView('categories/update', [
                'category' => $categoryData,
                'errors' => $errors
            ]);
        }

        public static function delete(Router $router) {
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                $id = $_POST['category-id'] ?? null;
                if (!$id) {
                    header("Location: /products");
                    exit();
                }
                $router->categoryManager->deleteCategory($id);
                header("Location: /category/management");
                exit();
            }                 
            $router->renderView('categories/delete');
        }
    }