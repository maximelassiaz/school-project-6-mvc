<?php
    $title = "GameXChange - Login";
?>

<h1 class="text-center">Login</h1>

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

<form method="POST" class="mx-5 mt-3 mx-auto p-3 login-form w-50">
    <div class="form-group">
        <label for="login-email">Email address</label>
        <input type="email" class="form-control" id="login-email" name="login-email">
    </div>
    <div class="form-group">
        <label for="login-password">Password</label>
        <input type="password" class="form-control" id="login-password" name="login-password">
    </div>
    <button type="submit" class="btn">Login</button> <br>
    <a href="/admin/login">Log as administrator</a>
</form>