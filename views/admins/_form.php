<form method="POST" class="mx-5 mt-3 mx-auto p-3 w-50">
    <div class="form-group">
        <label for="admin-username">Username</label>
        <input type="text" class="form-control" id="admin-username" name="admin-username" value="<?= isset($admin) ? htmlspecialchars($admin['admin_username']) : "";?>">
    </div>
    <div class="form-group">
        <label for="admin-email">Email</label>
        <input type="email" class="form-control" id="admin-email" name="admin-email"  value="<?= isset($admin) ? htmlspecialchars($admin['admin_email']) : "" ;?>">
    </div>
    <div class="form-group">
        <label for="admin-password">Password</label>
        <input type="password" class="form-control" id="admin-password" name="admin-password">
    </div>
    <div class="form-group">
        <label for="admin-passwordConfirm">Confirm password</label>
        <input type="password" class="form-control" id="admin-passwordConfirm" name="admin-passwordConfirm">
    </div>
    <?php
        // retrieve path last part for the button name
        $urlDivided = explode("/",$_SERVER['PATH_INFO']);
        $path = ucfirst(end($urlDivided));
    ?>
    <button type="submit" class="btn" name="admin-submit"><?= $path ?></button>
</form>