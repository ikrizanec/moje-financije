<?php
require_once __SITE_PATH . '/model/saving_service.class.php';
require_once __SITE_PATH . '/model/users_service.class.php';

class SavingsController {

    public function index() {
        //dodat dohvacanje svih transakcija u varijablu $savings
        if ( isset($_SESSION['username'] ) ) {
            $us = new UserService();
            $user = $us->getUserByUsername( $_POST['username'] );
            $id_user = $user->id_user;
            $ss = new SavingService();
            $savings = $ss->getSavingsByUserID( $id_user );
            
            include __SITE_PATH . '/view/saving_list.php';
        }
    }

    public function add() {
        //ako su poslani podaci s forme, dodat ih, prihazat poruku o uspješnom dodavanju ($message) i vratit se na formu za dodavanje:
        $message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ( isset($_SESSION['username']) && isset($_POST['savings_name']) && isset($_POST['savings_goal'] && isset($_POST['deadline'])) 
            && !empty($_POST['savings_name']) && !empty($_POST['savings_goal'])  && !empty($_POST['deadline']) ) {
                $ss = new SavingService();
                $savingsName = $_POST['savings_name'];
                $savingsGoal = $_POST['savings_goal'];
                $savingsDeadline = $_POST['deadline'];

                $us = new UserService();
                $user = $us->getUserByUsername( $_POST['username'] );
                $idUser = $user->id_user;
                $balance = 0;

                $ss->addSaving( $idUser, $savingsName, $savingsGoal, $balance, $savingsDeadline );
                $message = "Saving successfully created.";
            } else {
                $message = "Please fill in savings name, goal and deadline.";
            }
        }
        include __SITE_PATH . '/view/saving_add.php';
    }

    public function add_contribution() {
        //ako su poslani podaci s forme, dodat ih, prihazat poruku o uspješnom dodavanju ($message) i vratit se na formu za dodavanje:
        $message = null;
        include __SITE_PATH . '/view/saving_contribution_add.php';
    }

}
