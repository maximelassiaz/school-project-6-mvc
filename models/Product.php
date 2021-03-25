<?php

    namespace app\models;

    class Product {

        public ?int $id = null; // can be optional
        public ?string $title = null;
        public ?string $description = null;
        public ?float $price = null;
        public ?string $imagePath = null;
        public ?array $imageFile = null;

        public function load($data) {

            $this->_id = $data['id'] ?? null;
            $this->_title = $data['title'];
            $this->_description = $data['description'] ?? '';
            $this->_price = $data['price'];
            $this->_imageFile = $data['imageFile'] ?? null;
            $this->_imagePath = $data['imagePath'] ?? null;
        }

        public function save() {
            $errors = [];
            if (!$this->title) {
                $errors[] = 'Product title is required';
            }
            // if (!$this->description) {
            //     $errors[] = 'Product description is required';
            // }
            if (!$this->price) {
                $errors[] = 'Product price is required';
            }
            if (empty($errors)) {
            // check if image file name exists already after uniqid
            // create new image function
            }
            return $errors;
        }
    }