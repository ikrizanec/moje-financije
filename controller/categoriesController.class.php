<?php
class CategoriesController {

    public function index() {
        //dodat dohvacanje svih kategorija u varijablu $categories
        $categories = [];
        include __SITE_PATH . '/view/category_list.php';
    }

    public function add() {
        //ako su poslani podaci s forme, dodat ih, prihazat poruku o uspješnom dodavanju ($message) i vratit se na formu za dodavanje:
        $message = null;
        include __SITE_PATH . '/view/category_add.php';
    }

}
