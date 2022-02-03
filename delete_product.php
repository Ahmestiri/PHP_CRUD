<?php
    //Connect to DataBase
    $pdo = new PDO('mysql:host=localhost; port=3306; dbname=crud 1', 'root', '');
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Acquire ID from POST request
    $id = $_POST['id'] ?? null;
    if (!$id){
        header("Location: index.php");
        exit;
    }
    //Delete Data from DB
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