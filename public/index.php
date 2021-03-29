<?php

    session_start();

    require_once __DIR__ . "/../vendor/autoload.php";

    use app\Router;
    use app\controllers\ProductController;
    use app\controllers\UserController;
    use app\controllers\AdminController;
    use app\controllers\CategoryController;

    $router = new Router();

    // Product
    $router->get('/', [ProductController::class, 'home']);
    $router->get('/products', [ProductController::class, 'home']);
    $router->get('/products/home', [ProductController::class, 'home']);
    $router->get('/products/management', [ProductController::class, 'management']);
    $router->get('/products/details', [ProductController::class, 'details']);
    $router->post('/products/details', [ProductController::class, 'details']);
    $router->get('/products/contact', [ProductController::class, 'contact']);
    $router->post('/products/contact', [ProductController::class, 'contact']);
    $router->get('/products/buy', [ProductController::class, 'buy']);
    $router->post('/products/buy', [ProductController::class, 'buy']);
    $router->get('/products/user', [ProductController::class, 'user']);
    $router->get('/products/create', [ProductController::class, 'create']);
    $router->post('/products/create', [ProductController::class, 'create']);
    $router->get('/products/update', [ProductController::class, 'update']);
    $router->post('/products/update', [ProductController::class, 'update']);
    $router->get('/products/delete', [ProductController::class, 'delete']);
    $router->post('/products/delete', [ProductController::class, 'delete']);

    // User
    $router->get('/user', [UserController::class, 'home']);
    $router->get('/user/home', [UserController::class, 'home']);
    $router->get('/user/management', [UserController::class, 'management']);
    $router->get('/user/login', [UserController::class, 'login']);
    $router->post('/user/login', [UserController::class, 'login']);
    $router->get('/user/signup', [UserController::class, 'signup']);
    $router->post('/user/signup', [UserController::class, 'signup']);
    $router->get('/user/update', [UserController::class, 'update']);
    $router->post('/user/update', [UserController::class, 'update']);
    $router->get('/user/delete', [UserController::class, 'delete']);
    $router->post('/user/delete', [UserController::class, 'delete']);
    $router->get('/logout', [UserController::class, 'logout']);

    // Admin
    $router->get('/admin', [AdminController::class, 'home']);
    $router->get('/admin/home', [AdminController::class, 'home']);
    $router->get('/admin/management', [AdminController::class, 'management']);
    $router->get('/admin/login', [AdminController::class, 'login']);
    $router->post('/admin/login', [AdminController::class, 'login']);
    $router->get('/admin/create', [AdminController::class, 'create']);
    $router->post('/admin/create', [AdminController::class, 'create']);
    $router->get('/admin/update', [AdminController::class, 'update']);
    $router->post('/admin/update', [AdminController::class, 'update']);
    $router->get('/admin/delete', [AdminController::class, 'delete']);
    $router->post('/admin/delete', [AdminController::class, 'delete']);
    $router->get('/logout', [AdminController::class, 'logout']);

    // Category
    $router->get('/category', [CategoryController::class, 'management']);
    $router->get('/category/home', [CategoryController::class, 'management']);
    $router->get('/category/management', [CategoryController::class, 'management']);
    $router->get('/category/create', [CategoryController::class, 'create']);
    $router->post('/category/create', [CategoryController::class, 'create']);
    $router->get('/category/update', [CategoryController::class, 'update']);
    $router->post('/category/update', [CategoryController::class, 'update']);
    $router->get('/category/delete', [CategoryController::class, 'delete']);
    $router->post('/category/delete', [CategoryController::class, 'delete']);

    $router->resolve();

