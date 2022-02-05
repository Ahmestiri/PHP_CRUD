<?php
    //Connect to DataBase
    $pdo = new PDO('mysql:host=localhost; port=3306; dbname=crud 1', 'root', '');
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>