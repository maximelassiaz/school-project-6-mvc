<?php
    if (!$product) {
        header("Location: home");
        exit();
    }
?>

<h1 class="text-center"><?= htmlspecialchars($product['product_title']) ;?></h1>


<div class="container mt-5">
    <div class="row">
        <div class="col">
            <img src="/product_image/<?= htmlspecialchars($product['product_image'])?>" class="img-fluid" alt="">
        </div>
        <div class="col">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" colspan="2" class="text-center">Informations</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Title</th>
                        <td><?= htmlspecialchars($product['product_title']) ;?></td>
                    </tr>
                    <tr>
                        <th scope="row">Description</th>
                        <td><?= htmlspecialchars($product['product_description']) ;?></td>
                    </tr>
                    <tr>
                        <th scope="row">Category</th>
                        <td><?= htmlspecialchars($product['category_name']) ;?></td>
                    </tr>
                    <tr>
                        <th scope="row">Region</th>
                        <td><?= htmlspecialchars($product['region_name']) ;?></td>
                    </tr>
                    <tr>
                        <th scope="row">Price</th>
                        <td><?= htmlspecialchars($product['product_price']) ;?>£</td>
                    </tr>
                    <tr>
                        <th scope="row">Seller</th>
                        <td><?= htmlspecialchars($product['user_username']) ;?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


