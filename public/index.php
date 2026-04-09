<?php
session_start(); // POUR QUE LA CONNEXION FONCTIONNE

// Autoload maison 
spl_autoload_register(function ($class) {
    $path = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($path)) {
        require_once $path;
    }
});

use App\Core\Router;

$router = new Router();
$router->run();