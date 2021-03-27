<?php

    session_start();

    require_once __DIR__ . "/../vendor/autoload.php";

    use app\Router;
    use app\controllers\ProductController;
    use app\controllers\UserController;
    use app\controllers\Admin;
    use app\controllers\Category;

    $router = new Router();

    // Product
    $router->get('/', [ProductController::class, 'home']);
    $router->get('/products', [ProductController::class, 'home']);
    $router->get('/products/home', [ProductController::class, 'home']);
    $router->get('/products/details', [ProductController::class, 'details']);
    $router->get('/products/user', [ProductController::class, 'user']);
    $router->get('/products/create', [ProductController::class, 'create']);
    $router->post('/products/create', [ProductController::class, 'create']);
    $router->get('/products/update', [ProductController::class, 'update']);
    $router->post('/products/update', [ProductController::class, 'update']);
    $router->post('/products/delete', [ProductController::class, 'delete']);

    // User
    $router->get('/user', [UserController::class, 'home']);
    $router->get('/user/login', [UserController::class, 'login']);
    $router->post('/user/login', [UserController::class, 'login']);
    $router->get('/user/signup', [UserController::class, 'signup']);
    $router->get('/logout', [UserController::class, 'logout']);
    // Admin

    // Category

    $router->resolve();

