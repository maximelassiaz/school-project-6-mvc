<h1 class="text-center">Admins Management</h1>

<!-- TODO add category and region selection -->
<form class=" w-50 mx-auto mt-5">
    <div class="input-group mb-3">
        <input type="text" name="search" class="form-control" placeholder="Search" value="<?php echo $search ?>">
        <div class="input-group-append">
            <button class="btn" type="submit">Search</button>
        </div>
    </div>
</form>

<a class="btn m-3" href="/admin/create" role="button">Create new admin</a>

<table class="table table-responsive mt-2">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col" colspan="2">Management</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($admins as $a) {
        ?>
        <tr>
            <th scope="row"><?= htmlspecialchars($a['admin_id']) ?></th>
            <td><?= htmlspecialchars($a['admin_username']) ?></td>
            <td><?= htmlspecialchars($a['admin_email']) ?></td>
            <td>
                <a class="btn warning" href="/admin/update?id=<?= htmlspecialchars($a['admin_id'])?>" role="button">Update</a>
            </td>
            <td>
                <a class="btn danger" href="/admin/delete?id=<?= htmlspecialchars($a['admin_id'])?>" role="button">Delete</a>
            </td>
        </tr>
        <?php
            }
        ?>
    </tbody>
</table>

