<?php

    namespace app\models;


    class User {
        public ?int $id = null; // can be optional
        public ?string $fname = null;
        public ?string $lname = null;
        public ?string $email = null;
        public ?string $password = null;
        public ?string $passwordConfirm = null;
        public ?string $username = null;

        public function load($data) {

            $this->id = $data['user_id'] ?? null;
            $this->fname = $data['user_fname'] ?? null;
            $this->lname = $data['user_lname'] ?? null;
            $this->email = $data['user_email'];
            $this->password = $data['user_password'];
            $this->passwordConfirm = $data['user_passwordConfirm'] ?? null;
            $this->username = $data['user_username'] ?? null;
        }

        public function save() {
            $errors = [];
            if (!$this->fname) {
                $errors[] = 'First name is required';
            }

            if (!$this->lname) {
                $errors[] = 'Last name is required';
            }

            if (!$this->email) {
                $errors[] = 'Email is required';
            }

            if (!$this->password) {
                $errors[] = 'Password is required';
            }

            if ($this->password !== $this->passwordConfirm) {
                $errors[] = 'Passwords must match';
            }

            if (!$this->username) {
                $errors[] = 'Username is required';
            }

            if (empty($errors)) {
                        
                $um = UserManager::$userManager;
                if ($this->id) {
                    $um->updateUser($this);
                } else {
                    $um->createUser($this);
                }
            }
            return $errors;
        }

        public function login() {
            $errors = [];
            if (!$this->email) {
                $errors[] = "Email is required";
            }

            if (!$this->password) {
                $errors[] = "Password is required";
            }

            return $errors;
        }
    }