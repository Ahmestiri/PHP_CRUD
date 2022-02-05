<?php
    //Connect to DataBase
    $pdo = new PDO('mysql:host=localhost; port=3306; dbname=crud 1', 'root', '');
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Acquire ID from GET request
    $id = $_GET['id'] ?? null;
    if (!$id){
        header("Location: index.php");
        exit;   
    }
    //Select Data from DB
    $statement = $pdo -> prepare("  SELECT * 
                                    FROM products
                                    WHERE id = :id   ");
    $statement -> bindValue(':id', $id);
    $statement -> execute();
    $product = $statement->fetch(PDO::FETCH_ASSOC);
    //Initializing variables
    $errors = [];
    $title = $product["title"];
    $description = $product["description"];
    $price = $product["price"];
    //Acquire from POST Request & Insert Data to DB
    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        //Acquire Data from POST request
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        //Form Validation
        if (!$title)
            $errors[] = 'Product Title is Missing.';
        if (!$price)
            $errors[] = 'Product Price is Missing.';
        //Create images folder
        if (!is_dir('images'))
            mkdir('images');
        //Update Data into DB
        if (empty($errors)){
            #Test if image uploaded
            $image = $_FILES["image"] ?? null;
            $imagePath = $product['image'];
            if ($image && $image['tmp_name']){
                if ($product['image'])
                    unlink($product['image']);
                $imagePath = "images/".$image['name'];
                move_uploaded_file($image["tmp_name"], $imagePath);
            }
            #Update Data into DB
            $statement = $pdo -> prepare(  "UPDATE products
                                            SET image = :image, title = :title, description = :description, price = :price
                                            WHERE id = :id" );
            #Bind Values
            $statement -> bindValue(':image', $imagePath);
            $statement -> bindValue(':title', $title);
            $statement -> bindValue(':description', $description);
            $statement -> bindValue(':price', $price);
            $statement -> bindValue(':id', $id);
            #Execute Insertion
            $statement -> execute();
            #Redirect to first Page
            header("Location: index.php");
        }
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $product['title'] ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>

<body style="padding:30px 50px">
    <h1 style="font-weight:bold">Update : <?php echo $product['title'] ?></h1>
    <!--Form Validation-->
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error) : ?>
                <div><?php echo $error ?></div>
            <?php endforeach; ?>    
        </div>
    <?php endif; ?>
    <!--Go Back Button-->
    <a href="index.php" type="button" class="btn btn-secondary" style="margin:30px 0px 10px">Go back to Products</a>
    <!--Form-->
    <form action="" method="post" enctype="multipart/form-data">
        <?php if ($product['image']) : ?>
            <img style="margin:10px -15px;width:120px" src="<?php echo $product['image'] ?>">
        <?php endif; ?>
        <div class="mb-3">
            <label>Product Image</label><br>
            <input type="file" name="image">
        </div>
        <div class="mb-3">
            <label>Product Title</label>
            <input type="text" class="form-control" name="title" value = "<?php echo $title?>">
        </div>
        <div class="mb-3">
            <label>Product Description</label>
            <textarea type="text" class="form-control" name="description" value = "<?php echo $description?>"></textarea>
        </div>
        <div class="mb-3">
            <label>Product Price in DT</label>
            <input type="number" step =".01" class="form-control" name="price" value = "<?php echo $price?>">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>  
</body>
</html>