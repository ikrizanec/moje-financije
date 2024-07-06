<?php

require_once __SITE_PATH .  '/model/user_service.class.php';

class UsersController {

    public function index() {
        include __SITE_PATH . '/view/login.php';
    }

    public function showLoginForm($error = null) {
        include __SITE_PATH . '/view/login.php';
    }

    public function logout() {
        session_destroy();
        include __SITE_PATH . '/view/login.php';
    }

    public function home() {
        include __SITE_PATH . '/view/user_home.php';
    }
}
