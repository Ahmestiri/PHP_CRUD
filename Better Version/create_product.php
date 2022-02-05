<?php
    //Require Connection to DB
    require_once("database.php");
    //Initializing variables
    $errors = [];
    $title = "";
    $description = "";
    $price ="";
    $product = ['image' => ""];    
    //Acquire from POST Request & Insert Data to DB
    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        //Require Acquiring data from form
        require_once("acquire_data.php");
        //Insert Data into DB
        if (empty($errors)){
            #Test if image uploaded
            $image = $_FILES["image"] ?? null;
            $imagePath = '';
            if ($image){
                $imagePath = "images/".$image['name'];
                move_uploaded_file($image["tmp_name"], $imagePath);
            }
            #Add Data to DB
            $statement = $pdo -> prepare("  INSERT INTO products (image, title, description, price, create_date) 
                                            VALUES (:image, :title, :description, :price, :date)    ");
            #Bind Values
            $statement -> bindValue(':image', $imagePath);
            $statement -> bindValue(':title', $title);
            $statement -> bindValue(':description', $description);
            $statement -> bindValue(':price', $price);
            $statement -> bindValue(':date', $date);
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
    <h1 style="font-weight:bold">Create Product</h1>
    <!--Include Form-->
    <?php include_once "./views/create-update/form.php" ?>  
</body>
</html>