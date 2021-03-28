<?php

    namespace app\models;


    class Product {

        public ?int $id = null; // can be optional
        public ?string $title = null;
        public ?string $description = null;
        public ?float $price = null;
        public ?string $imageName = null;
        public ?array $imageFile = null;
        public ?int $categoryId = null;
        public ?int $regionId = null;
        public ?int $userId = null;

        public function load($data) {

            $this->id = $data['product_id'] ?? null;
            $this->title = $data['product_title'];
            $this->description = $data['product_description'];
            $this->imageFile = $data['product_imageFile'] ?? null;
            $this->imageName = $data['product_imageFile']['name'] ?? null;
            $this->price = $data['product_price'];
            $this->categoryId = $data['category_id'];
            $this->regionId = $data['region_id'];
            $this->userId = $data['user_id'];
        }

        public function save() {
            $errors = [];
            if (!$this->title) {
                $errors[] = 'Product title is required';
            }

            if (!$this->description) {
                $errors[] = 'Product description is required';
            }

            if ($this->imageFile && $this->imageName) {
                $imageName = $this->imageFile['name'];
                $imageTmpName =  $this->imageFile['tmp_name'];
                $imageSize =  $this->imageFile['size'];
                $imageError =  $this->imageFile['error'];

                $imageExt = explode('.', $imageName);
                $imageActualExt = strtolower(end($imageExt));
                $allowedExt = ['jpg', 'jpeg', 'png', 'pdf'];

                if (!in_array($imageActualExt, $allowedExt)) {
                    $errors[] = "Image extension must be \"jpg\", \"png\", \"jpeg\" or \"pdf\""; 
                } 
                
                if ($imageError != 0) {
                    $errors[] = "An error occured with your image, please try again";
                } 
                
                if ($imageSize > 10000000) {
                    $errors[] = "Image size is too large";
                } 
            }

            if (!$this->price) {
                $errors[] = 'Product price is required';
            }

            if (!$this->categoryId) {
                $errors[] = 'Product category is required';
            }

            if (!$this->categoryId) {
                $errors[] = 'Product category is required';
            }

            if (!$this->regionId) {
                $errors[] = 'Product region is required';
            }

            if (!$this->userId) {
                $errors[] = 'Product user id is required';
            }

            

            if (empty($errors)) {
                
                if($this->imageName){
                    $imageNameNew = uniqid('', true) . "." . $imageActualExt;
                    $this->imageName = $imageNameNew;
                    $imageDestination = "product_image/" . $imageNameNew;
                    move_uploaded_file($imageTmpName, $imageDestination);
                }    
                        
                $pm = ProductManager::$productManager;
                if ($this->id) {
                    $pm->updateProduct($this);
                } else {
                    $pm->createProduct($this);
                }
            }

            return $errors;
        }
    }