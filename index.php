<?php
session_start();

define('__SITE_PATH', realpath(dirname(__FILE__)));
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$site_url = $protocol . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
define('__SITE_URL', $site_url);

if (!isset($_GET['rt'])) {
    $con = 'users';
    $action = 'showLoginForm';
} else {
    $rt = $_GET['rt'];
    $x = explode('/', $rt);
    if (count($x) === 1) {
        $con = $x[0];
        $action = 'index';
    } else {
        $con = $x[0];
        $action = $x[1];
    }
}

$controllerName = $con . 'Controller';
require_once __SITE_PATH . '/controller/' . $controllerName . '.class.php';
$c = new $controllerName;
$c->$action();

?>