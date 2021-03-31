<?php
    $title = "GameXChange - Products exchanged";
?>

<h1 class="text-center">Games currently exchanged</h1>

<form class="form-inline form-search justify-content-center mt-5 w-50 mx-auto">
    <input type="text" name="search" class="form-control my-2 mr-sm-2 mx-2" placeholder="Search" value="<?php echo $search ?>">
    <select class="form-control my-2 mr-sm-2 mx-2" id="category" name="category">
                <option value="">Select a category</option>
                <?php
                    foreach ($categories as $c) {
                ?>
                <option value="<?= htmlspecialchars($c['category_id'])?>"><?= htmlspecialchars($c['category_name']);?></option>
                <?php
                    }
                ?>
    </select>
    <select class="form-control my-2 mr-sm-2 mx-2" id="region" name="region">
                <option value="">Select a region</option>
                <?php
                    foreach ($regions as $r) {
                ?>
                <option value="<?= htmlspecialchars($r['region_id'])?>"><?= htmlspecialchars($r['region_name']);?></option>
                <?php
                    }
                ?>
    </select>
    <button class="btn my-2 mr-sm-2 mx-2" type="submit">Search</button>
    <a class="btn my-2 mr-sm-2 mx-2" href="/products" role="button">Reset</a>
</form>

<div class="row row-cols-1 mx-5 mt-5 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
    <?php
        foreach($products as $p) {
    ?>
    <div class="col mb-4">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h4 class="card-title text-center"><?= htmlspecialchars($p['product_title']) ;?></h4>
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

<?php
    $path = "";

?>

<ul class="pagination w-25 mx-auto">
    <li>
        <a href="products?page=1">First</a>
    </li>
    <li class="<?= $page <= 1 ? 'disabled' : '' ?>">
        <a href="products<?= $page <= 1 ? '' : "?page=". ($page - 1) ?>">Prev</a>
    </li>
    <li class="<?= $page >= $total_pages ? 'disabled' : '' ?>">
        <a href="products<?= $page >= $total_pages ? '' : "?page=".($page + 1) ?>">Next</a>
    </li>
    <li>
        <a href="products?page=<?= $total_pages; ?>">Last</a>
    </li>
</ul>


