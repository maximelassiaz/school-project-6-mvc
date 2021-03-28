<?php
    

    namespace app\controllers;

    use app\models\Admin;
    use app\Router;

    class AdminController {

        public static function home(Router $router) {
            $id = $_SESSION['admin']['admin_id']; 
            $admin = $router->adminManager->getAdminById($id);
            $router->renderView('admins/home', [
                'admin' => $admin
            ]);
        }

        public static function management(Router $router) {
            $search = $_GET['search'] ?? "";
            $admins = $router->adminManager->getAdmins($search);
            $router->renderView('admins/management', [
                'admins' => $admins,
                'search' => $search
            ]);
        }

        public static function create(Router $router) {
            $errors = [];
            $adminData = [
                'admin_email' => '',
                'admin_password' => '',
                'admin_passwordConfirm' => '',
                'admin_username' => ''
            ];
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {               
                $adminData['admin_email'] = $_POST['admin-email'];
                $adminData['admin_password'] = $_POST['admin-password'];
                $adminData['admin_passwordConfirm'] = $_POST['admin-passwordConfirm'];
                $adminData['admin_username'] = $_POST['admin-username'];

                $admin = new Admin();
                $admin->load($adminData);
                $errors = $admin->save();
                if (empty($errors)) {
                    header('Location: /products');
                    exit();
                }    

            }
            $router->renderView('admins/create', [
                'product' => $adminData,
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
            $adminData = $router->adminManager->getAdminbyId($id);
            if ($_SERVER['REQUEST_METHOD'] === "POST") {               
                $adminData['admin_email'] = $_POST['admin-email'];
                $adminData['admin_password'] = $_POST['admin-password'];
                $adminData['admin_passwordConfirm'] = $_POST['admin-passwordConfirm'];
                $adminData['admin_username'] = $_POST['admin-username'];

                $admin = new Admin();
                $admin->load($adminData);
                $errors = $admin->save();
                if (empty($errors)) {
                    header('Location: /admin');
                    exit();
                }  
            }
            $router->renderView('admins/update', [
                'admin' => $adminData,
                'errors' => $errors
            ]);
        }

        public static function delete(Router $router) {
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                $id = $_GET['id'] ?? null;
                if (!$id) {
                    header("Location: /products");
                    exit();
                }
                $router->adminManager->deleteAdmin($id);
                if ($id == $_SESSION['admin']['admin_id']) {
                    header("Location: /logout");
                    exit();
                }
                header("Location: /admin/management");
                exit();
            }
            $router->renderView('admins/delete');            
        }

        public static function login(Router $router) {
            $adminData = [
                "admin_email" => "",
                "admin_password" => ""
            ];
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                $adminData['admin_email'] = $_POST['login-email'];
                $adminData['admin_password'] = $_POST['login-password'];

                $admin = new Admin();
                $admin->load($adminData);
                $errors = $admin->login();
                if (!empty($errors)) {
                    $router->renderView('admins/login', [
                        'errors' => $errors
                    ]);
                } else {
                    $adminLogin = $router->adminManager->loginAdmin($admin);
                    session_start();
                    $_SESSION['admin'] = $adminLogin;  
                    header("Location: /products");
                    exit();
                }             
            }
            $router->renderView('admins/login', [
                'admin' => $adminData
            ]);
        }

        public static function logout(Router $router) {
            $router->renderView('logout');
        }
    }