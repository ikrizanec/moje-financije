<?php
class TransactionsController {

    public function index() {
        //dodat dohvacanje svih transakcija u varijablu $transactions
        $transactions = [];
        include __SITE_PATH . '/view/transaction_list.php';
    }


    public function add() {
        //ako su poslani podaci s forme, dodat ih, prihazat poruku o uspješnom dodavanju ($message) i vratit se na formu za dodavanje:
        $message = null;
        include __SITE_PATH . '/view/transaction_add.php';
    }

}
