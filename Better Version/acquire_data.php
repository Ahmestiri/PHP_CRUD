<?php
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
