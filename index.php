<?php
    //Connect to DataBase
    $pdo = new PDO('mysql:host=localhost; port=3306; dbname=php_crud', 'root', '');
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Acquire Search from GET request
    $search = $_GET['search'] ?? "" ;
    //Select Data from DB
    if ($search){
        #Read Data from DB
        $statement = $pdo -> prepare("  SELECT * 
                                        FROM products
                                        WHERE title LIKE :title
                                        ORDER BY create_date DESC   ");
        #Bind Values
        $statement -> bindValue(':title', "%$search%");
    }
    else{
        #Read Data from DB
        $statement = $pdo -> prepare("  SELECT * 
                                        FROM products
                                        ORDER BY create_date DESC   ");
    }
    //Execute Reading
    $statement -> execute();
    //Fetch statement into associative array
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products CRUD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body style="padding:30px 50px">
    <h1 style="font-weight:bold">Products CRUD</h1>
    <!--Create Product Button-->
    <a href="create_product.php" type="button" class="btn btn-success" style="margin:30px 0px 10px">Create Product</a>
    <!--Search Form-->
    <form>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search for products" name = "search" value="<?php echo $search?>">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
        </div>
    </form>
    <!--Products Table-->
    <table class="table">
        <!--Table Header-->
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Title</th>
            <th scope="col">Price</th>
            <th scope="col">Create Date</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <!--Table Body-->
        <tbody>
            <?php foreach ($products as $i => $product) : ?>
                <tr>
                    <th style = "line-height:50px" scope="row"><?php echo $i+1 ?></th>
                    <td><img style = "width:50px" src="<?php echo $product['image'] ?>"></td>
                    <td style = "line-height:50px"><?php echo $product['title'] ?></td>
                    <td style = "line-height:50px"><?php echo $product['price'] ?></td>
                    <td style = "line-height:50px"><?php echo $product['create_date'] ?></td>
                    <td style = "line-height:40px">
                        <!--Edit Button-->
                        <a href="update_product.php?id=<?php echo $product['id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                        <!--Delete Button-->
                        <form method="post" action="delete_product.php" style="display:inline-block">
                            <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>    
</body>
</html>