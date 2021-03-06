<?php
//Connect to DataBase
$pdo = new PDO('mysql:host=localhost; port=3306; dbname=php_crud', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//Initializing variables
$errors = [];
$title = "";
$description = "";
$price = "";
//Acquire from POST Request & Insert Data to DB
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //Acquire Data from POST request
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $date = date('Y-m-d H:i:s');
    //Form Validation
    if (!$title)
        $errors[] = 'Product Title is Missing.';
    if (!$price)
        $errors[] = 'Product Price is Missing.';
    //Create images folder
    if (!is_dir('images'))
        mkdir('images');
    //Insert Data into DB
    if (empty($errors)) {
        #Test if image uploaded
        $image = $_FILES["image"] ?? null;
        $imagePath = '';
        if ($image) {
            $imagePath = "images/" . $image['name'];
            move_uploaded_file($image["tmp_name"], $imagePath);
        }
        #Add Data to DB
        $statement = $pdo->prepare("  INSERT INTO products (image, title, description, price, create_date) 
                                            VALUES (:image, :title, :description, :price, :date)    ");
        #Bind Values
        $statement->bindValue(':image', $imagePath);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':date', $date);
        #Execute Insertion
        $statement->execute();
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
    <title>Create Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>

<body style="padding:30px 50px">
    <h1 style="font-weight:bold">Create Product</h1>
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
    <form action="create_product.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Product Image</label><br>
            <input type="file" name="image">
        </div>
        <div class="mb-3">
            <label>Product Title</label>
            <input type="text" class="form-control" name="title" value="<?php echo $title ?>">
        </div>
        <div class="mb-3">
            <label>Product Description</label>
            <textarea type="text" class="form-control" name="description" value="<?php echo $description ?>"></textarea>
        </div>
        <div class="mb-3">
            <label>Product Price in DT</label>
            <input type="number" step=".01" class="form-control" name="price" value="<?php echo $price ?>">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>

</html>