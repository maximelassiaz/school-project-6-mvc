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

<div class="container mt-5">
    <div class="row">
        <div class="col">
            <form method="POST" class="p-3" enctype="multipart/form-data">
            <?php
                if ($product['product_image']) {
            ?>
                <img src="product_image/<?= htmlspecialchars($product['product_image']);?>" alt="">
            <?php
                }
            ?>
                <div class="form-group">
                    <label for="product-title">Product title</label>
                    <input type="text" class="form-control" name="product-title" id="product-title" value="<?= htmlspecialchars($product['product_title']);?>">
                </div>
                <div class="form-group">
                    <label for="product-description">Product description</label>
                    <textarea class="form-control" id="product-description" name="product-description" rows="3" value="<?= $product['product_description'];?>"><?= htmlspecialchars($product['product_description']) ?? '' ;?></textarea>
                </div>
                <div class="form-group">
                    <label for="product-image">Product image</label>
                    <input type="file" class="form-control" name="product-image" id="product-image" value="<?= htmlspecialchars($product['product_image']);?>">
                </div>
                <div class="form-group">
                    <label for="product-price">Product price</label>
                    <input type="number" min="0" step=".01" class="form-control" name="product-price" id="product-price" value="<?= htmlspecialchars($product['product_price']);?>">
                </div>
                <div class="form-group">
                <label for="product-region">Region</label>
                    <select class="form-control" id="product-region" name="product-region">
                        <option value="<?= isset($product['regon_id']) ? htmlspecialchars($product['region_id']) : "";?>"><?= isset($product['region_name']) ? htmlspecialchars($product['region_name']) : "Choose a region" ;?></option>
                        <option value="1">East Midlands</option>
                        <option value="2">East of England</option>
                        <option value="3">London</option>
                        <option value="4">North East</option>
                        <option value="5">North West</option>
                        <option value="6">South West</option>
                        <option value="7">South West</option>
                        <option value="8">West Midlands</option>
                        <option value="9">Yorkshire and the Humber</option>
                    </select>
                </div>
                <div class="form-group">
                <label for="product-category">Category</label>
                    <select class="form-control" id="product-category" name="product-category">
                        <option value="<?= isset($product['category_id']) ? htmlspecialchars($product['category_id']) : "";?>"><?= isset($product['category_name']) ? htmlspecialchars($product['category_name']) : "Choose a category" ;?></option>
                        <?php // TODO : take category object to create it dynamically ?>
                        <option value="1">Playstation 4</option>
                        <option value="2">Playstation 5</option>
                        <option value="3">Nintendo Switch</option>
                        <option value="4">Wii U</option>
                        <option value="5">PC</option>
                    </select>
                </div>
                <?php
                    // retrieve path last part for the button name
                    $urlDivided = explode("/",$_SERVER['PATH_INFO']);
                    $path = ucfirst(end($urlDivided));
                ?>
                <button type="submit" name="product-submit" class="btn btn-primary ml-5"><?= $path ;?></button>
            </form>
        </div>
        <div class="col">
            <img id="imgDisplay" class="img-fluid" src="">
        </div>
    </div>
</div>



