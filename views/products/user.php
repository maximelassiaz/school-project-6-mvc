<?php
    $title = "GameXChange - My products";
?>

<h1 class="text-center">My products</h1>

<table class="table table-responsive-md w-75 mt-5 mx-auto">
    <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col">Price</th>
            <th scope="col">Category</th>
            <th scope="col">Region</th>
            <th scope="col" colspan="3">Management</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($products as $p) {
        ?>
        <tr>
            <th scope="row"><?= htmlspecialchars($p['product_title']) ;?></th>
            <td><?= htmlspecialchars($p['product_price']);?>£</td>
            <td><?= htmlspecialchars($p['category_name']);?></td>
            <td><?= htmlspecialchars($p['region_name']) ;?></td>
            <td>
                <a class="btn" href="/products/details?id=<?= htmlspecialchars($p['product_id']);?>" role="button">Details</a>
            </td>
            <td>
                <a class="btn warning" href="/products/update?id=<?= htmlspecialchars($p['product_id']);?>" role="button">Edit</a>
            </td>
            <td>
                <a class="btn danger" href="/products/delete?id=<?= htmlspecialchars($p['product_id']);?>" role="button">Delete</a>
            </td>
        </tr>
        <?php
            }
        ?>
    </tbody>
</table>