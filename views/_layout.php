<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title><?= $title ?? "GameMarket" ?></title>
</head>
<body>
    <nav class="navbar navbar-expand-md mb-5 navbar-dark bg-dark">
        <a class="navbar-brand" href="/">GameMarket</a>
        <span class="text-white"><?= $_SESSION['user']['user_fname'] ?? "" ?></span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <?php
                if (isset($_SESSION['user'])) {
            ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownUserProducts" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    My products
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownUserProducts">
                    <a class="dropdown-item" href="#">My products</a>
                    <a class="dropdown-item" href="/products/create">Add a product</a>
                </div>
            </li>
            <?php 
                }
                if(isset($_SESSION['admin'])) {
            ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownManagement" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Management
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownManagement">
                    <a class="dropdown-item" href="#">Products</a>
                    <a class="dropdown-item" href="#">Users</a>
                    <a class="dropdown-item" href="#">Admins</a>
                    <a class="dropdown-item" href="#">Categories</a>
                </div>
            </li>
            <?php
                }
                if (!isset($_SESSION['user'])) {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="/user/login">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Register</a>
            </li>
            <?php 
                }
                if (isset($_SESSION['user'])) {
            ?>
             <li class="nav-item">
                <a class="nav-link" href="/user">Account</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/logout">Logout</a>
            </li>
            <?php
                }
            ?>
        </div>
    </nav>

    <?= $content ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>