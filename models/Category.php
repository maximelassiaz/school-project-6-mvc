<?php

    namespace app\models;


    class Category {

        public ?int $id = null; // can be optional
        public ?string $name = null;

        public function load($data) {

            $this->id = $data['category_id'] ?? null;
            $this->name = $data['category_name'];
        }

        public function save() {
            $errors = [];
            if (!$this->name) {
                $errors[] = 'Category name is required';
            }
            if (empty($errors)) {               
                $cm = CategoryManager::$categoryManager;
                if ($this->id) {
                    $cm->updateCategory($this);
                } else {
                    $cm->createCategory($this);
                }
            }

            return $errors;
        }
    }