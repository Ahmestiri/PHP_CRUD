<!--Form Validation-->
<?php if (!empty($errors)) : ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error) : ?>
            <div><?php echo $error ?></div>
        <?php endforeach; ?>    
    </div>
<?php endif; ?>
<!--Go Back Button-->
<a href="../index.php" type="button" class="btn btn-secondary" style="margin:30px 0px 10px">Go back to Products</a>
<!--Form-->
<form action="" method="post" enctype="multipart/form-data">
    <?php if ($product['image']) : ?>
        <img style="margin:10px -15px;width:120px" src="<?php echo $product['image']?>">
    <?php endif; ?>
    <div class="mb-3">
        <label>Product Image</label><br>
        <input type="file" name="image">
    </div>
    <div class="mb-3">
        <label>Product Title</label>
            <input type="text" class="form-control" name="title" value = "<?php echo $product['title']?>">
    </div>
    <div class="mb-3">
        <label>Product Description</label>
        <textarea type="text" class="form-control" name="description" value = "<?php echo $product['description']?>"></textarea>
    </div>
    <div class="mb-3">
        <label>Product Price in DT</label>
        <input type="number" step =".01" class="form-control" name="price" value = "<?php echo $product['price']?>">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>  