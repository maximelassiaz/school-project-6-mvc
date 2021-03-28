<?php
    

    namespace app\controllers;

    use app\models\User;
    use app\Router;

    class UserController {

        public static function home(Router $router) {
            $id = $_SESSION['user']['user_id']; 
            $user = $router->userManager->getUserById($id);
            $router->renderView('users/home', [
                'user' => $user
            ]);
        }

        public static function management(Router $router) {
            $search = $_GET['search'] ?? "";
            $users = $router->userManager->getUsers($search);
            $router->renderView('users/management', [
                'users' => $users,
                'search' => $search
            ]);
        }

        public static function signup(Router $router) {
            $errors = [];
            $userData = [
                'user_fname' => '',
                'user_lname' => '',
                'user_email' => '',
                'user_password' => '',
                'user_passwordConfirm' => '',
                'user_username' => ''
            ];
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $userData['user_fname'] = $_POST['user-fname'];
                $userData['user_lname'] = $_POST['user-lname'];                
                $userData['user_email'] = $_POST['user-email'];
                $userData['user_password'] = $_POST['user-password'];
                $userData['user_passwordConfirm'] = $_POST['user-passwordConfirm'];
                $userData['user_username'] = $_POST['user-username'];

                $user = new User();
                $user->load($userData);
                $errors = $user->save();
                if (empty($errors)) {
                    header('Location: /products');
                    exit();
                }    

            }
            $router->renderView('users/signup', [
                'product' => $userData,
                'errors' => $errors
            ]);
        }

        public static function update(Router $router) {
            $id = $_SESSION['user']['user_id'] ?? null;
            if (!$id) {
                header("Location: /products");
                exit();
            }
            $errors = [];
            $userData = $router->userManager->getUserbyId($id);
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                $userData['user_fname'] = $_POST['user-fname'];
                $userData['user_lname'] = $_POST['user-lname'];                
                $userData['user_email'] = $_POST['user-email'];
                $userData['user_password'] = $_POST['user-password'];
                $userData['user_passwordConfirm'] = $_POST['user-passwordConfirm'];
                $userData['user_username'] = $_POST['user-username'];

                $user = new User();
                $user->load($userData);
                $errors = $user->save();
                if (empty($errors)) {
                    header('Location: /user');
                    exit();
                }  
            }
            $router->renderView('users/update', [
                'user' => $userData,
                'errors' => $errors
            ]);
        }

        public static function delete(Router $router) {
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                $id = $_POST['user-id'] ?? null;
                if ($_SESSION['admin']) {
                    $router->userManager->deleteUser($id);
                    header("Location: /user/management");
                    exit();
                } else {
                    $idUser = $_SESSION['user']['user_id'] ?? null;
                    if (!$idUser) {
                        header("Location: /products");
                        exit();
                    }
                    $router->userManager->deleteUser($id);
                    header("Location: /logout");
                    exit();
                }                   
            }
            $router->renderView('users/delete');            
        }

        public static function login(Router $router) {
            $userData = [
                "user_email" => "",
                "user_password" => ""
            ];
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                $userData['user_email'] = $_POST['login-email'];
                $userData['user_password'] = $_POST['login-password'];

                $user = new User();
                $user->load($userData);
                $errors = $user->login();
                if (!empty($errors)) {
                    $router->renderView('users/login', [
                        'errors' => $errors
                    ]);
                } else {
                    $userLogin = $router->userManager->loginUser($user);
                    session_start();
                    $_SESSION['user'] = $userLogin;  
                    header("Location: /products");
                    exit();
                }             
            }
            $router->renderView('users/login', [
                'user' => $userData
            ]);
        }

        public static function logout(Router $router) {
            $router->renderView('logout');
        }
    }