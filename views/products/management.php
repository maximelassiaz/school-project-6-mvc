<?php
    $title = "GameXChange - Products management";
?>

<h1 class="text-center">Products Management</h1>

<form class="form-inline form-search justify-content-center mt-5 w-50 mx-auto">
    <input type="text" name="search" class="form-control m-2 mr-sm-2" placeholder="Search" value="<?php echo $search ?>">
    <select class="form-control m-2 mr-sm-2" id="category" name="category">
                <option value="">Select a category</option>
                <?php
                    foreach ($categories as $c) {
                ?>
                <option value="<?= htmlspecialchars($c['category_id'])?>"><?= htmlspecialchars($c['category_name']);?></option>
                <?php
                    }
                ?>
    </select>
    <select class="form-control m-2 mr-sm-2" id="region" name="region">
                <option value="">Select a region</option>
                <?php
                    foreach ($regions as $r) {
                ?>
                <option value="<?= htmlspecialchars($r['region_id'])?>"><?= htmlspecialchars($r['region_name']);?></option>
                <?php
                    }
                ?>
    </select>
    <button class="btn m-2 mr-sm-2" type="submit">Search</button>
    <a class="btn m-2 mr-sm-2" href="/products" role="button">Reset</a>
</form>

<table class="table table-responsive-md mt-5">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Price</th>
            <th scope="col">Category</th>
            <th scope="col">Region</th>
            <th scope="col">Seller</th>
            <th scope="col" colspan="2">Management</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($products as $p) {
        ?>
        <tr>
            <th scope="row"><?= htmlspecialchars($p['product_id']) ?></th>
            <td><?= htmlspecialchars($p['product_title']) ?></td>
            <td><?= htmlspecialchars($p['product_price']) ?>£</td>
            <td><?= htmlspecialchars($p['category_name']) ?></td>
            <td><?= htmlspecialchars($p['region_name']) ?></td>
            <td><?= htmlspecialchars($p['user_username']) ?></td>
            <td>
                <a class="btn" target="_blank" href="/products/details?id=<?= htmlspecialchars($p['product_id'])?>" role="button">Details</a>
            </td>
            <td>
                <a class="btn danger" href="/products/delete?id=<?= htmlspecialchars($p['product_id'])?>" role="button">Delete</a>
            </td>
        </tr>
        <?php
            }
        ?>
    </tbody>
</table>

<ul class="pagination w-25 mx-auto">
    <li>
        <a href="management?page=1">First</a>
    </li>
    <li class="<?= $page <= 1 ? 'disabled' : '' ?>">
        <a href="management<?= $page <= 1 ? '' : "?page=". ($page - 1) ?>">Prev</a>
    </li>
    <li class="<?= $page >= $total_pages ? 'disabled' : '' ?>">
        <a href="management<?= $page >= $total_pages ? '' : "?page=".($page + 1) ?>">Next</a>
    </li>
    <li>
        <a href="management?page=<?= $total_pages; ?>">Last</a>
    </li>
</ul>