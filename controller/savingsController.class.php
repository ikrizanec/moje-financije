<?php
require_once __SITE_PATH . '/model/saving_service.class.php';
require_once __SITE_PATH . '/model/saving.class.php';
require_once __SITE_PATH . '/model/users_service.class.php';

class SavingsController {

    public function index() {
        if ( isset( $_GET['action'] ) && isset( $_SESSION['username'] ) && $_GET['action'] === 'list') {
            try {
                $us = new UserService();
                $user = $us->getUserByUsername( $_SESSION['username'] );
                $id_user = $user->id_user;
                $ss = new SavingService();
                $savings = $ss->getSavingsByUserID( $id_user );
            } catch (PDOException $e) {
                error_log("PDO Error: " . $e->getMessage());
                $this->sendJSONandExit(['status' => 'error', 'message' => 'Database error occurred']);
            }

            $message['savings'] = $savings;
            $this->sendJSONandExit($message);
        } else {
            include __SITE_PATH . '/view/saving_list.php';
        }
    }

    public function add() {
        //ako su poslani podaci s forme, dodat ih, prihazat poruku o uspješnom dodavanju ($message) i vratit se na formu za dodavanje:
        $message = '';
        include __SITE_PATH . '/view/saving_add.php';
    }

    public function add_contribution() {
        //ako su poslani podaci s forme, dodat ih, prihazat poruku o uspješnom dodavanju ($message) i vratit se na formu za dodavanje:
        $message = '';
        include __SITE_PATH . '/view/saving_contribution_add.php';
    }

}
