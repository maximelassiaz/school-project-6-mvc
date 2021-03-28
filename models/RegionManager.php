<?php

    namespace app\models;

    use PDO;

    class RegionManager extends Database {

        public static RegionManager $regionManager;

        // initialize PDO connexion to dabatase
        public function __construct() {
            $this->conn = new PDO('mysql:host=localhost;dbname=webmarket;charset=utf8', 'root', '');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            self::$regionManager = $this;
        }

        // get all categories matching the search expression, or all categories if no search is made
        public function getRegions() {
            $sql = "SELECT * FROM region
            ORDER BY region_name";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }