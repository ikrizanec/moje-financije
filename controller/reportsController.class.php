<?php

require_once __SITE_PATH . '/model/transactions_service.class.php';
require_once __SITE_PATH . '/model/user_service.class.php';
require_once __SITE_PATH . '/tfpdf/tfpdf.php';
require_once __SITE_PATH . '/model/saving_service.class.php';
require_once __SITE_PATH . '/model/savingscontributions_service.class.php';

class ReportsController {

    public function index() {
        if (isset($_POST['action']) && isset($_SESSION['username']) && $_POST['action'] === 'generate') {
            if (isset($_POST['begin_date']) && isset($_POST['end_date'])) {
                try {
                    $us = new UserService();
                    $user = $us->getUserByUsername($_SESSION['username']);
                    $id_user = $user->id_user;
                    $ts = new TransactionsService();
                    $ss = new SavingService();
                    $scs = new SavingsContributionsService();
                    $begin_date = $_POST['begin_date'];
                    $end_date = $_POST['end_date'];
                    $transactions = $ts->getTransactionsByDate($id_user, $begin_date, $end_date);
                    $savings = $ss->getSavingsByUserID($id_user);

                    $contributions = [];
                    foreach ($savings as $saving) {
                        $saving_id = $saving->id_savings;
                        $saving_contributions = $scs->getSavingsContributionsBySavingsID($saving_id);
                        $contributions[$saving_id] = $saving_contributions;
                    }

                    if ($transactions !== false && $savings !== false && $contributions !== false) {
                        $pdf = $this->generatePDF($transactions, $savings, $contributions, $begin_date, $end_date);
                        $this->sendPDF($pdf);
                    } else {
                        $this->sendJSONandExit(['status' => 'error', 'message' => 'No report found.']);
                    }
                } catch (PDOException $e) {
                    error_log("PDO Error: " . $e->getMessage());
                    $this->sendJSONandExit(['status' => 'error', 'message' => 'Database error occurred']);
                }
            } else {
                $this->sendJSONandExit(['status' => 'error', 'message' => 'Invalid input data']);
            }
        } else {
            include __SITE_PATH . '/view/report.php';
        }
    }

    private function generatePDF($transactions, $savings, $contributions, $begin_date, $end_date) {
        $pdf = new TFPDF();
        $pdf->AddPage();
        $pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
        $pdf->SetFont('DejaVu','',14);
        
        $pdf->Cell(0, 10, "Report from $begin_date to $end_date", 0, 1, 'C');
        $pdf->Ln();

        if (!empty($transactions)) {
            $pdf->Cell(0, 10, 'Transactions', 0, 1, 'L');
            $pdf->Ln();
            $pdf->SetFont('DejaVu', '', 12);
            $pdf->Cell(30, 10, 'Date', 1);
            $pdf->Cell(90, 10, 'Description', 1);
            $pdf->Cell(30, 10, 'Amount', 1);
            $pdf->Ln();

            foreach ($transactions as $transaction) {
                $pdf->Cell(30, 10, $transaction->transaction_date, 1);
                $pdf->Cell(90, 10, $transaction->description, 1);
                $pdf->Cell(30, 10, $transaction->amount, 1);
                $pdf->Ln();
            }

            $pdf->Ln(10);
        }
        else {
            $pdf->Cell(0, 10, 'No transactions found.', 0, 1, 'C');
            $pdf->Ln(10);  
        }

        if (!empty($savings)) {
            foreach ($savings as $saving) {
                $saving_id = $saving->id_savings;
                if (isset($contributions[$saving_id])) {
                    $pdf->Cell(0, 10, "Savings: {$saving->savings_name}", 0, 1, 'L');
                    $pdf->Ln();
                    $pdf->Cell(30, 10, 'Date', 1);
                    $pdf->Cell(30, 10, 'Contribution', 1);
                    $pdf->Ln();

                    $flag = 0;
                    foreach ($contributions[$saving_id] as $contribution) {
                        if ($contribution->contribution_date >= $begin_date && $contribution->contribution_date <= $end_date) {
                            $pdf->Cell(30, 10, $contribution->contribution_date, 1);
                            $pdf->Cell(30, 10, $contribution->payment_amount, 1);
                            $pdf->Ln();
                            $flag = 1;
                        }
                    }

                    if(!$flag) {
                        $pdf->Cell(0, 10, 'No contributions found.', 1);
                        $pdf->Ln();
                    }
                } else {
                    $pdf->Cell(0, 10, 'No contributions found.', 1);
                    $pdf->Ln();
                }

                $pdf->Ln(10);
            }
        }

        return $pdf;
    }

    private function sendPDF($pdf) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="report.pdf"');
        $pdf->Output('report.pdf', 'D');
        exit;
    }

    public function sendJSONandExit($message) {
        header('Content-type:application/json;charset=utf-8');
        echo json_encode($message);
        flush();
        exit(0);
    }
}
?>