<?php
namespace app\models;
use app\Database;

class Product{
    public ?int $id = null;
    public ?string $title = null;
    public ?string $description = null;
    public ?float $price = null;
    public ?string $imagePath = null;
    public ?array $imageFile = null;

    public function load($data){
        $this->id = $data['id'] ?? null; 
        $this->title = $data['title'];
        $this->description = $data['description'] ?? '';
        $this->price = $data['price'];
        $this->imageFile = $data['imageFile'] ?? null;
        $this->imagePath = $data['image'] ?? null;
    }

    public function save(){
        $errors = [];
        //Form Validation
        if (!$this->title)
            $errors[] = 'Product Title is Missing.';
        if (!$this->price)
            $errors[] = 'Product Price is Missing.';
        //Create images folder
        if (!is_dir('../public/images'))    
            mkdir('../public/images');
        //Insert Data into DB
        if (empty($errors)){
            #Test if image uploaded
            if ($this->imageFile){
                $this->imagePath = "images/".$this->imageFile['name'];
                move_uploaded_file($this->imageFile["tmp_name"], $this->imagePath);
            }
            $db = Database::$db;
            if ($this->id){
                $db->updateProduct($this);
            }
            else{
                $db->createProduct($this);
            }
        }
        return $errors;
    }
} 