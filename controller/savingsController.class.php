<?php
require_once __SITE_PATH . '/model/saving_service.class.php';
require_once __SITE_PATH . '/model/saving.class.php';
require_once __SITE_PATH . '/model/user_service.class.php';

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
        if ( isset( $_POST['action'] ) && isset( $_SESSION['username'] ) && $_POST['action'] === 'add' )
        {
            $us = new UserService();
            $user = $us->getUserByUsername( $_SESSION['username'] );
            $id_user = $user->id_user;
            $ss = new SavingService();
            $savings_name = $_POST['savings_name'];
            $savings_goal = $_POST['savings_goal'];
            $current_balance = 0;
            $deadline = $_POST['deadline'];
            $ss->addSaving( $id_user, $savings_name, $savings_goal, $current_balance, $deadline );
            
            $message['message'] = 'Saving added successfully!';
            $this->sendJSONandExit($message);
        } 
        else 
        {
            include __SITE_PATH . '/view/saving_add.php';
        }
    }

    public function add_contribution() {
        if ( isset( $_POST['action'] ) && isset( $_SESSION['username'] ) && $_POST['action'] === 'add_contribution' )
        {
            $us = new UserService();
            $user = $us->getUserByUsername( $_SESSION['username'] );
            $id_user = $user->id_user;
            $sc = new SavingsContributionsService();
            $id_savings = $_POST['id_savings'];
            $payment_amount = $_POST['payment_amount'];
            $contribution_date = date('Y-m-d');
            $new_balance = $user->balance - $payment_amount;
            if ( $new_balance >= 0 )
            {
                $sc->addSavingsContributions( $id_savings, $payment_amount, $contribution_date );
                $message['message'] = 'Saving added successfully!';
                $us->updateBalance( $id_user, $new_balance );
                $ss = new SavingService();
                $saving = $ss->getSavingById( $id_savings );
                $current_balance = $saving->current_balance;
                $new_savings_balance = $current_balance + $payment_amount;
                $ss->updateSavingsBalance( $id_savings, $new_savings_balance );

                $this->sendJSONandExit($message);
            }
            else {
                $message['message'] = 'Balance too low to make this contribution.';
                $this->sendJSONandExit($message);
            }
        } 
        else 
        {
            include __SITE_PATH . '/view/saving_list.php.php';
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
