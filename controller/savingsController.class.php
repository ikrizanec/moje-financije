<?php
class SavingsController {

    public function index() {
        //dodat dohvacanje svih transakcija u varijablu $savings
        $savings = [];
        include __SITE_PATH . '/view/saving_list.php';
    }

    public function add() {
        //ako su poslani podaci s forme, dodat ih, prihazat poruku o uspješnom dodavanju ($message) i vratit se na formu za dodavanje:
        $message = null;
        include __SITE_PATH . '/view/saving_add.php';
    }

    public function add_contribution() {
        //ako su poslani podaci s forme, dodat ih, prihazat poruku o uspješnom dodavanju ($message) i vratit se na formu za dodavanje:
        $message = null;
        include __SITE_PATH . '/view/saving_contribution_add.php';
    }

}
