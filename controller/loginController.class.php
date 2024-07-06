<?php

require_once __SITE_PATH .  '/model/user_service.class.php';

class LoginController {

    public function index() {
		if( !isset( $_POST['username'] ) || !isset( $_POST['password'] ) )
		{
            echo json_encode(['status' => 'error', 'message' => 'Username or password not set.']);
			include __SITE_PATH . '/view/login.php';
		}
		else {
            $us = new UserService();
            $user = $us->getUserByUsername( $_POST['username'] );

            if( $user === null )
            {
                echo json_encode(['status' => 'error', 'message' => 'User with this username does not exist.']);
                header( 'Location: ' . __SITE_URL . '/index.php?rt=login' );
            }
            else if( $_POST['password'] !== $user->password_hash )
            {
                echo json_encode(['status' => 'error', 'message' => 'Incorrect password.']);
                header( 'Location: ' . __SITE_URL . '/index.php?rt=login' );
            }
            else
            {
                echo "Login successful.\n";
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['id_user'] = $user -> id_user;
                $_SESSION['name'] = $user -> name;
                $_SESSION['surname'] = $user -> surname;
                $_SESSION['admin'] = $user -> is_admin;

                echo json_encode(['status' => 'success', 'message' => 'Login successful.']);
                
                header( 'Location: ' . __SITE_URL . '/index.php?rt=users/home' );
            }
		}
    }
}


?>