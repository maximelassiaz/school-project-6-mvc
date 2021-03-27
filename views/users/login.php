<h1 class="text-center">Login</h1>

<?php 
    if(isset($errors)) {
        print_r($errors);
    }
?>

<form method="POST" class="mx-5">
    <div class="form-group">
        <label for="login-email">Email address</label>
        <input type="email" class="form-control" id="login-email" name="login-email">
    </div>
    <div class="form-group">
        <label for="login-password">Password</label>
        <input type="password" class="form-control" id="login-password" name="login-password">
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>