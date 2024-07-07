<?php

require_once __SITE_PATH .  '/model/user_service.class.php';

class UsersController {

    public function index() {
        include __SITE_PATH . '/view/login.php';
    }

    public function login() {
		if( !isset( $_POST['username'] ) || !isset( $_POST['password'] ) )
		{
			include __SITE_PATH . '/view/login.php';
		}
		else {
            $us = new UserService();
            $user = $us->getUserByUsername( $_POST['username'] );

            var_dump($_POST);

            if( $user === null )
            {
                header( 'Location: ' . __SITE_URL . '/index.php?rt=users/login' );
            }
            else if( !password_verify( $_POST['password'], $user->password_hash ) )
            {
                header( 'Location: ' . __SITE_URL . '/index.php?rt=login' );
            }
            else
            {
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['id_user'] = $user -> id_user;
                $_SESSION['name'] = $user -> name;
                $_SESSION['surname'] = $user -> surname;
                $_SESSION['admin'] = $user -> is_admin;
                
                header( 'Location: ' . __SITE_URL . '/index.php?rt=users/home' );
            }
		}
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
