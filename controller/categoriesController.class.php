<?php

require_once __SITE_PATH . '/model/category_service.class.php';
require_once __SITE_PATH . '/model/category.class.php';

class CategoriesController {

    public function index() {
        if (isset($_GET['action']) && $_GET['action'] === 'list') {
            try {
                $cs = new CategoryService();
                $categories = $cs->getAllCategories();
            } catch (PDOException $e) {
                error_log("PDO Error: " . $e->getMessage());
                $this->sendJSONandExit(['status' => 'error', 'message' => 'Database error occurred']);
            }

            $message['categories'] = $categories;
            $this->sendJSONandExit($message);
        } else {
            include __SITE_PATH . '/view/category_list.php';
        }
    }

    public function add() {
        // $message = '';

        // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //     if (isset($_POST['category-name']) && isset($_POST['category-description']) && !empty($_POST['category-name']) && !empty($_POST['category-description'])) {
        //         $cs = new CategoryService();
        //         $categoryName = $_POST['category-name'];
        //         $categoryDescription = $_POST['category-description'];

        //         $cs->addCategory($categoryName, $categoryDescription);
        //         $message = "Category successfully added.";
        //     } else {
        //         $message = "Please fill in both the category name and description.";
        //     }
        // }

        include __SITE_PATH . '/view/category_add.php';
    }

    public function sendJSONandExit( $message )
    {
        header( 'Content-type:application/json;charset=utf-8' );
        echo json_encode( $message );
        flush();
        exit( 0 );
    }
}

?>
