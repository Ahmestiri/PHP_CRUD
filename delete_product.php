<?php
    //Connect to DataBase
    $pdo = new PDO('mysql:host=localhost; port=3306; dbname=crud 1', 'root', '');
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Get The ID of the element
    $id = $_POST['id'] ?? null;
    //In case ID not found
    if (!$id){
        header("Location: index.php");
        exit;
    }
    //Delete product based on the ID
    $statement = $pdo -> prepare("  DELETE
                                    FROM products
                                    WHERE id = :id  ");
    //Bind Values
    $statement -> bindValue(':id', $id);
    //Execute Deletion
    $statement -> execute();
    //Redirect to first Page
    header("Location: index.php");
?>