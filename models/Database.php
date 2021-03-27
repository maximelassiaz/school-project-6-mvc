<?php

    namespace app\models;
    
    use PDO;

    class Database {

        public \PDO $conn;
        public static Database $db;

        // initialize PDO connexion to dabatase
        public function __construct() {
            $this->conn = new PDO('mysql:host=localhost;dbname=webmarket;charset=utf8', 'root', '');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            self::$db = $this;
        }

    }