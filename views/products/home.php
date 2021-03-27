<h1 class="text-center">Games currently exchanged</h1>

<!-- TODO add category and region selection -->
<form action="" method="get">
    <div class="input-group mb-3">
        <input type="text" name="search" class="form-control" placeholder="Search" value="<?php echo $search ?>">
        <div class="input-group-append">
        <button class="btn btn-info" type="submit">Search</button>
        </div>
    </div>
</form>

<div class="row row-cols-1 mx-5 mt-5 row-cols-md-3 row-cols-lg-4">
    <?php
        foreach($products as $p) {
    ?>
    <div class="col mb-4">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <!-- TODO : hide with ellipsis if too long -->
                <h4 class="card-title"><?= htmlspecialchars($p['product_title']) ;?></h4>
            </div>
            <img src="/product_image/<?= htmlspecialchars($p['product_image']) ;?>" class="card-img-top" alt="...">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <?= htmlspecialchars($p['product_price']) . "£";?>
                </li>
                <li class="list-group-item">
                    <?= htmlspecialchars($p['category_name']) ?>
                </li>
                <li class="list-group-item">
                    <?= htmlspecialchars($p['region_name']) ?>
                </li>
            </ul>
            <div class="card-body">
                <a href="/products/details?id=<?= htmlspecialchars($p['product_id']) ;?>" target="_blank" class="card-link">More details</a>
            </div>
        </div>
    </div>
    <?php
        }
    ?>
</div>


