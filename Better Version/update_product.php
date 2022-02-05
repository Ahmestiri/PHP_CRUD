<?php
    //Require Connection to DB
    require_once("database.php");
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
        //Require Acquiring data from form
        require_once("acquire_data.php");
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
<!--Include Header-->
<?php include_once "./views/partials/header.php"; ?>

<body style="padding:30px 50px">
    <h1 style="font-weight:bold">Update : <?php echo $product['title'] ?></h1>
    <!--Include Form-->
    <?php include_once "./views/create-update/form.php" ?>         
</body>
</html>