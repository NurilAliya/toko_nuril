<?php
// index.php - simple router
session_start();
require_once 'app/core/Database.php';
require_once 'app/core/Controller.php';
require_once 'app/core/Model.php';

$controller = isset($_GET['controller']) ? ucfirst($_GET['controller']) : 'Dashboard';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
$controllerFile = "app/controllers/{$controller}Controller.php";

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $className = $controller . 'Controller';
    $c = new $className();
    if (method_exists($c, $action)) {
        $c->$action();
    } else {
        echo 'Aksi tidak ditemukan.';
    }
} else {
    echo 'Halaman tidak ditemukan.';
}
?>