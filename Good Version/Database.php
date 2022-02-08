<?php
//Same PHP code of old index.php
namespace app;

use app\models\Product;
use PDO;
class Database{
    public PDO $pdo;
    public static Database $db;
    #Connection to DB
    public function __construct(){
        $this->pdo = new PDO('mysql:host=localhost; port=3306; dbname=crud 1', 'root', '');
        $this->pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$db = $this; 
    }
    #Get product by id
    public function getProductById($id){
        $statement = $this->pdo -> prepare("  SELECT * 
                                        FROM products
                                        WHERE id = :id   ");
        $statement -> bindValue(':id', $id);
        $statement -> execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    #Select data from DB
    public function getProducts($search = ''){ 
        if ($search){
            $statement = $this->pdo -> prepare("  SELECT * 
                                            FROM products
                                            WHERE title LIKE :title
                                            ORDER BY create_date DESC   ");
            $statement -> bindValue(':title', "%$search%");
        }
        else{
            $statement = $this->pdo -> prepare("  SELECT * 
                                            FROM products
                                            ORDER BY create_date DESC   ");
        }
        $statement -> execute();
        return ($statement->fetchAll(PDO::FETCH_ASSOC));
    }
    #Save data in DB
    public function createProduct(Product $product){ 
        $statement = $this->pdo -> prepare("    INSERT INTO products (image, title, description, price, create_date) 
                                                VALUES (:image, :title, :description, :price, :date)    ");
        $statement -> bindValue(':image', $product -> imagePath);
        $statement -> bindValue(':title', $product -> title);
        $statement -> bindValue(':description', $product -> description);
        $statement -> bindValue(':price', $product -> price);
        $statement -> bindValue(':date',date("Y-m-d H:i:s"));
        $statement -> execute();        
    }
    #Delete data from DB
    public function deleteProduct($id){ 
        $statement = $this->pdo -> prepare("  DELETE
                                        FROM products
                                        WHERE id = :id  ");
        $statement -> bindValue(':id', $id);
        $statement -> execute();
    }
    #Update data in DB
    public function updateProduct(Product $product){ 
        $statement = $this->pdo -> prepare(  "UPDATE products
                                            SET image = :image, title = :title, description = :description, price = :price
                                            WHERE id = :id" );
            #Bind Values
            $statement -> bindValue(':image', $product -> imagePath);
            $statement -> bindValue(':title', $product -> title);
            $statement -> bindValue(':description', $product -> description);
            $statement -> bindValue(':price', $product -> price);
            $statement -> bindValue(':id', $product -> id);
            #Execute Insertion
            $statement -> execute();     
    }
}
