<?php
class ReportsController {

    public function index() {
        //forma za generiranje reporta
        include __SITE_PATH . '/view/report_new.php';
    }

    public function show() {
        //ako su poslani podaci s forme, pronac podatke za report
        $report = [];
        include __SITE_PATH . '/view/report.php';
    }

}
