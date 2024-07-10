<?php

require_once __SITE_PATH . '/model/transactions_service.class.php';

class ReportsController {

    public function index() {
        if ( isset( $_POST['action'] ) && isset( $_SESSION['username'] ) && $_POST['action'] === 'generate' ) {
            if (isset($_POST['begin_date']) && isset($_POST['end_date'])) {
                try {
                    $us = new UserService();
                    $user = $us->getUserByUsername( $_SESSION['username'] );
                    $id_user = $user->id_user;
                    $ts = new TransactionsService();
                    $begin_date = $_POST['begin_date'];
                    $end_date = $_POST['end_date'];
                    $report = $ts->getTransactionsByDate( $id_user, $begin_date, $end_date );
                } catch (PDOException $e) {
                    error_log("PDO Error: " . $e->getMessage());
                    $this->sendJSONandExit(['status' => 'error', 'message' => 'Database error occurred']);
                }

                $message['report'] = $report;
                $this->sendJSONandExit($message);
            } else {
                $this->sendJSONandExit(['status' => 'error', 'message' => 'Invalid input data']);
            }
        } else {
            include __SITE_PATH . '/view/report.php';
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
?>
