<h1 class="text-center">Contact</h1>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg">           
            <img src="/product_image/<?= htmlspecialchars($product['product_image'])?>" class="img-fluid" alt="">
            <table class="table my-2">
                <thead>
                    <tr>
                        <th scope="col" colspan="2" class="text-center">Informations</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Title</th>
                        <td><?= htmlspecialchars($product['product_title']) ;?></td>
                    </tr>
                    <tr>
                        <th scope="row">Description</th>
                        <td><?= htmlspecialchars($product['product_description']) ;?></td>
                    </tr>
                    <tr>
                        <th scope="row">Category</th>
                        <td><?= htmlspecialchars($product['category_name']) ;?></td>
                    </tr>
                    <tr>
                        <th scope="row">Region</th>
                        <td><?= htmlspecialchars($product['region_name']) ;?></td>
                    </tr>
                    <tr>
                        <th scope="row">Price</th>
                        <td><?= htmlspecialchars($product['product_price']) ;?>£</td>
                    </tr>
                    <tr>
                        <th scope="row">Seller</th>
                        <td><?= htmlspecialchars($product['user_username']) ;?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-lg">
            <form method="POST" class="p-3">
                <div class="form-group">
                    <label for="message-subject">Subject</label>
                    <input type="text" class="form-control" id="message-subject" name="message-subject" value="<?= htmlspecialchars($product['product_title']);?>" readonly>
                </div>
                <div class="form-group">
                    <label for="message-content">Message</label>
                    <textarea class="form-control" id="message-content" name="message-content" rows="3"></textarea>
                </div>
                <button type="submit" class="btn" name="message-submit">Send message</button>
            </form>
        </div>
    </div>
</div>


