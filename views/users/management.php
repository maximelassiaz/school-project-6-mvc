<h1 class="text-center">Users Management</h1>

<!-- TODO add category and region selection -->
<form action="" method="get">
    <div class="input-group mb-3">
        <input type="text" name="search" class="form-control" placeholder="Search" value="<?php echo $search ?>">
        <div class="input-group-append">
            <button class="btn" type="submit">Search</button>
        </div>
    </div>
</form>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">First name</th>
            <th scope="col">Last name</th>
            <th scope="col">Email</th>
            <th scope="col">Management</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($users as $u) {
        ?>
        <tr>
            <th scope="row"><?= htmlspecialchars($u['user_id']) ?></th>
            <td><?= htmlspecialchars($u['user_username']) ?></td>
            <td><?= htmlspecialchars($u['user_fname']) ?></td>
            <td><?= htmlspecialchars($u['user_lname']) ?></td>
            <td><?= htmlspecialchars($u['user_email']) ?></td>
            <td>
                <a class="btn danger" href="/user/delete?id=<?= htmlspecialchars($u['user_id'])?>" role="button">Delete</a>
            </td>
        </tr>
        <?php
            }
        ?>
    </tbody>
</table>

