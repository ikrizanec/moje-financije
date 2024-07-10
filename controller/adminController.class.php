<?php

require_once __SITE_PATH .  '/model/user_service.class.php';

class AdminController {

    public function users() {
        $us = new UserService();

        if ($_SESSION['admin'] === '1') {
            $users = $us->getAllUsers();
            include __SITE_PATH . '/view/admin_users.php';
        }
    }

    public function newUser() {
        $us = new UserService();
    
        if (isset($_POST['action']) && isset($_SESSION['id_user']) && $_POST['action'] === 'add' ) {
    
            if ($_SESSION['admin'] === '1') {
                $username = $_POST['username'];
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $email = $_POST['email'];
                $name = $_POST['name'];
                $surname = $_POST['surname'];
                $balance = $_POST['balance'];
                $is_admin = isset($_POST['is_admin']) ? 1 : 0;
    
                $us->addUser($username, $password, $email,$is_admin, $name, $surname, $balance);
    
                $message['message'] = 'User added successfully!';
                $this->sendJSONandExit($message);
            } else {
                $message['error'] = 'Access denied';
                $this->sendJSONandExit($message);
            }
        } else {
            include __SITE_PATH . '/view/admin_users_add.php';
        }
    }

    public function deleteUser() {
        $us = new UserService();
    
        if (isset($_POST['action']) && isset($_SESSION['id_user']) && $_POST['action'] === 'delete' ) {
    
            if ($us->isAdmin($_SESSION['id_user'])) {
                $id_user = $_POST['id_user'];
    
                $us->deleteUserById($id_user);
    
                $message['message'] = 'User deleted successfully!';
                $this->sendJSONandExit($message);
            } else {
                $message['error'] = 'Access denied';
                $this->sendJSONandExit($message);
            }
        } else {
            include __SITE_PATH . '/view/admin_users_add.php';
        }
    }

    public function sendJSONandExit( $message )
    {
        header( 'Content-type:application/json;charset=utf-8' );
        echo json_encode( $message );
        flush();
        exit( 0 );
    }
}
