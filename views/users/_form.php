<?php 
    if (!empty($errors)){ 
?>
<div class="alert alert-danger text-center w-50 mx-auto mt-5">
    <?php 
        foreach ($errors as $error){
    ?>
         <div><?= $error ?></div>
    <?php
        } 
    ?>
   </div>
<?php 
    }
?>

<form method="POST" class="mx-5 mt-3 mx-auto p-3 w-50">
    <div class="form-group">
        <label for="user-username">Username</label>
        <input type="text" class="form-control" id="user-username" name="user-username" value="<?= isset($user) ? htmlspecialchars($user['user_username']) : "";?>">
    </div>
    <div class="form-group">
        <label for="user-fname">First name</label>
        <input type="text" class="form-control" id="user-fname" name="user-fname" value="<?= isset($user) ? htmlspecialchars($user['user_fname']) : "";?>">
    </div>
    <div class="form-group">
        <label for="user-lname">Last name</label>
        <input type="text" class="form-control" id="user-lname" name="user-lname" value="<?= isset($user) ? htmlspecialchars($user['user_lname']) : "" ;?>">
    </div>
    <div class="form-group">
        <label for="user-email">Email</label>
        <input type="email" class="form-control" id="user-email" name="user-email"  value="<?= isset($user) ? htmlspecialchars($user['user_email']) : "" ;?>">
    </div>
    <div class="form-group">
        <label for="user-password">Password</label>
        <input type="password" class="form-control" id="user-password" name="user-password">
    </div>
    <div class="form-group">
        <label for="user-passwordConfirm">Confirm password</label>
        <input type="password" class="form-control" id="user-passwordConfirm" name="user-passwordConfirm">
    </div>
    <?php
        // retrieve path last part for the button name
        $urlDivided = explode("/",$_SERVER['PATH_INFO']);
        $path = ucfirst(end($urlDivided));
    ?>
    <button type="submit" class="btn" name="user-submit"><?= $path ?></button>
</form>