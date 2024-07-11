<?php

require_once __SITE_PATH . '/model/transactions_service.class.php';
require_once __SITE_PATH . '/model/category_service.class.php';
require_once __SITE_PATH . '/model/transactions.class.php';
require_once __SITE_PATH . '/model/user_service.class.php';

class TransactionsController {

    public function index() 
    {
        if (isset($_SESSION['username'])) 
        {
            if (isset($_GET['action']) && $_GET['action'] === 'list') 
            {
                $ts = new TransactionsService();
                $cs = new CategoryService();
                $user_id = $_SESSION['id_user'];
                $transactions = $ts->getAllTransactions($user_id);
                $categories = $cs->getCategoryNames();
        
                $category_lookup = [];
                foreach ($categories as $category) {
                    $category_lookup[$category['id_category']] = $category['category_name'];
                }
        
                $transactions_with_category_names = [];
                foreach ($transactions as $transaction) {
                    $transaction_array = [
                        'amount' => $transaction->__get('amount'),
                        'transaction_date' => $transaction->__get('transaction_date'),
                        'description' => $transaction->__get('description'),
                        'type' => $transaction->__get('type'),
                        'category_name' => $category_lookup[$transaction->__get('id_category')]
                    ];
                    $transactions_with_category_names[] = $transaction_array;
                }
    
                $message['transactions'] = $transactions_with_category_names;
                $this->sendJSONandExit($message);
            } 
            else 
            {
                include __SITE_PATH . '/view/transaction_list.php';
            }
        } 
        else 
        {
            include __SITE_PATH . '/view/login.php';
        }
    }


    public function add() 
    {
        $ts = new TransactionsService();
        $cs = new CategoryService();
        $categories = $cs->getCategoryNames();

        if (isset($_SESSION['username'])) 
        {
            $user_id = $_SESSION['id_user'];
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $amount = $_POST['amount'];
                $description = $_POST['description'];
                $type = $_POST['type'] ;
                $category = $_POST['category'];
                $date = $_POST['date'];
    
                $success = $ts->addTransaction($user_id, $category, $amount, $date, $description, $type);
    
                $us = new UserService();
                $user = $us->getUserByUsername($_SESSION['username']);
    
                if ($type === 'expense') {
                    $new_balance = $user->__get('balance') - $amount;
                } elseif ($type === 'income') {
                    $new_balance = $user->__get('balance')  + $amount;
                } else {
                    $new_balance = $user->__get('balance') ;
                }
    
                if (!$us->updateBalance ($_SESSION['username'], $new_balance)) {
                    $success = false;
                };
    
                if ($success) {
                    $message['message'] = 'Transaction added successfully!';
                    $this->sendJSONandExit($message);
                } else {
                    $message['message'] = 'Failed to add transaction!';
                    $this->sendJSONandExit($message);
                }
            } else {
                include __SITE_PATH . '/view/transaction_add.php';
            }
        } 
        else 
        {
            include __SITE_PATH . '/view/login.php';
        }
    }

    public function sendJSONandExit($message) 
    {
        header('Content-type:application/json;charset=utf-8');
        echo json_encode($message);
        exit(0);
    }

}
