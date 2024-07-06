<?php

require_once __SITE_PATH .  '/model/user_service.class.php';

class UsersController {

    public function index() {
        var_dump($_POST);
        include __SITE_PATH . '/view/login.php';
    }

    public function login() {
        
        
        echo "pocinje prijava/n";
        //var_dump($_POST['username']);
        echo "/n";
        //var_dump($_POST['password']);echo "\n post:";
        var_dump($_POST);

		if( !isset( $_POST['username'] ) || !isset( $_POST['password'] ) )
		{
			include __SITE_PATH . '/view/login.php';
		}
		else {
            echo "else\n";
            $us = new UserService();
            $user = $us->getUserByUsername( $_POST['username'] );
            echo "dohvacenuser\n";
            var_dump($_POST['username']);

            if( $user === null )
            {
                echo "User wih this username does not exist.\n";
                header( 'Location: ' . __SITE_URL . '/index.php?rt=users/login' );
            }
            else if( !password_verify( $_POST['password'], $user->password_hash ) )
            {
                echo "Incorrent password.\n";
                header( 'Location: ' . __SITE_URL . '/index.php?rt=users/login' );
            }
            else
            {
                echo "Login successful.\n";
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['id_user'] = $user -> id_user;
                $_SESSION['name'] = $user -> name;
                $_SESSION['surname'] = $user -> surname;
                $_SESSION['admin'] = $user -> is_admin;

                header( 'Location: ' . __SITE_URL . '/index.php?rt=users/home' );
            }


            //header( 'Location: ' . __SITE_URL . '/index.php?rt=users/home' );
		}
    }

    private function showLoginForm($error = null) {
        include __SITE_PATH . '/view/login.php';
    }

    public function logout() {
        session_destroy();
        header('Location: ' . __SITE_URL . '/index.php?rt=users/login');
    }

    public function home() {
        include __SITE_PATH . '/view/user_home.php';
    }
}
