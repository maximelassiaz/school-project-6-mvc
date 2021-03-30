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

<form method="POST" class="w-50 mx-auto p-3 mt-5">
    <div class="form-group">
        <label for="category-name">Category name</label>
        <input type="text" class="form-control" name="category-name" id="category-name" value="<?= htmlspecialchars($category['category_name']);?>">
    </div>
    <?php
        // retrieve path last part for the button name
        $urlDivided = explode("/",$_SERVER['PATH_INFO']);
        $path = ucfirst(end($urlDivided));
    ?>
    <button type="submit" name="category-submit" class="btn btn-primary ml-5"><?= $path ;?></button>
</form>
