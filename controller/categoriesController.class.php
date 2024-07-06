<?php

require_once __SITE_PATH . '/model/category_service.class.php';

class CategoriesController {

    public function index() {
        $cs = new CategoryService();
        $categories = $cs->getAllCategories();
        include __SITE_PATH . '/view/category_list.php';
    }

    public function add() {
        $message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['category-name']) && isset($_POST['category-description'])) {
                $cs = new CategoryService();
                $categoryName = $_POST['category-name'];
                $categoryDescription = $_POST['category-description'];

                $cs->addCategory($categoryName, $categoryDescription);
                $message = "Uspješno dodana nova kategorija!";
            } else {
                $message = "Došlo je do greške. Unesite sva polja!";
            }
        }

        include __SITE_PATH . '/view/category_add.php';
    }
}

?>