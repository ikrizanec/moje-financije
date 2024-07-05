<?php
class UsersController {

    public function index() {
        header('Location: ' . __SITE_URL . '/index.php?rt=users/login');
    }

    public function login() {
        include __SITE_PATH . '/view/login.php';
        //dodat logiku za logiranje (ako prode, header location transactions list?..., ako ne  $error, pa header login form)
    }

    private function showLoginForm($error = null) {
        include __SITE_PATH . '/view/login.php';
    }

    public function logout() {
        session_destroy();
        header('Location: ' . __SITE_URL . '/index.php?rt=users/login');
    }
}
