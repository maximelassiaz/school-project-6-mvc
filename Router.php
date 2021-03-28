<?php

    namespace app;

    use app\models\Database;
    use app\models\ProductManager;
    use app\models\UserManager;
    use app\models\AdminManager;
    use app\models\CategoryManager;
    use app\models\RegionManager;

    class Router {

        public array $getRoutes = [];
        public array $postRoutes = [];
        public Database $db;
        public ProductManager $productManager;
        public UserManager $userManager;
        public AdminManager $adminManager;
        public CategoryManager $categoryManager;
        public RegionManager $regionManager;

        public function __construct() {
            $this->db = new Database();
            $this->productManager = new ProductManager();
            $this->userManager = new UserManager();
            $this->adminManager = new AdminManager();
            $this->categoryManager = new CategoryManager();
            $this->regionManager = new RegionManager();
        }

        public function get($url, $fn) {
            $this->getRoutes[$url] = $fn;
        }

        public function post($url, $fn) {
            $this->postRoutes[$url] = $fn;
        }

        public function resolve() {
            $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
            $method = $_SERVER['REQUEST_METHOD'];

            if ($method === "GET") {
                $fn = $this->getRoutes[$currentUrl] ?? null;
            } else {
                $fn = $this->postRoutes[$currentUrl] ?? null;
            }

            if ($fn) {
                call_user_func($fn, $this);
            } else {
                echo "Page not found";
            }
        }

        public function renderView($view, $params = []) {
            foreach ($params as $key => $value) {
                $$key = $value;
            }
            ob_start();
            include_once __DIR__ . "/views/$view.php";
            $content = ob_get_clean();
            include_once __DIR__ . "/views/_layout.php";
        }
    }