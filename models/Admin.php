<?php

    namespace app\models;


    class Admin {
        public ?int $id = null; // can be optional
        public ?string $email = null;
        public ?string $password = null;
        public ?string $passwordConfirm = null;
        public ?string $username = null;

        public function load($data) {

            $this->id = $data['admin_id'] ?? null;
            $this->email = $data['admin_email'];
            $this->password = $data['admin_password'];
            $this->passwordConfirm = $data['admin_passwordConfirm'] ?? null;
            $this->username = $data['admin_username'] ?? null;
        }

        public function save() {
            $errors = [];

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
                        
                $am = AdminManager::$adminManager;
                if ($this->id) {
                    $am->updateAdmin($this);
                } else {
                    $am->createAdmin($this);
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