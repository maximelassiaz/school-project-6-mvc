<h1 class="text-center">Categories Management</h1>

<a class="btn m-3" href="/category/create" role="button">Create new category</a>

<table class="table w-50 mx-auto">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Category</th>
            <th scope="col" colspan="2">Management</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($categories as $c) {
        ?>
        <tr>
            <th scope="row"><?= htmlspecialchars($c['category_id']) ?></th>
            <td><?= htmlspecialchars($c['category_name']) ?></td>
            <td>
                <a class="btn warning"" href="/category/update?id=<?= htmlspecialchars($c['category_id'])?>" role="button">Update</a>
            </td>
            <td>
                <a class="btn danger" href="/category/delete?id=<?= htmlspecialchars($c['category_id'])?>" role="button">Delete</a>
            </td>
        </tr>
        <?php
            }
        ?>
    </tbody>
</table>

