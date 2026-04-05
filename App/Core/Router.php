<?php

namespace App\Core;

class Router
{
    public function run()
    {
        $page = $_GET['page'] ?? 'home';

        switch ($page) {

            /* ============================
               PAGES PUBLIQUES
            ============================ */

            case 'home':
                $controller = new \App\Controllers\HomeController();
                $controller->index();
                break;

            case 'login':
                $controller = new \App\Controllers\AuthController();
                $controller->login();
                break;

            case 'logout':
                $controller = new \App\Controllers\AuthController();
                $controller->logout();
                break;


            /* ============================
               TRAJETS (UTILISATEUR)
            ============================ */

            case 'trajets':   // ⭐ AJOUT ESSENTIEL
                $controller = new \App\Controllers\TrajetController();
                $controller->index();
                break;

            case 'trajet-create':
                $controller = new \App\Controllers\TrajetController();
                $controller->create();
                break;

            case 'trajet-edit':
                $controller = new \App\Controllers\TrajetController();
                $controller->edit();
                break;

            case 'trajet-delete':
                $controller = new \App\Controllers\TrajetController();
                $controller->delete();
                break;


            /* ============================
               ADMINISTRATION
            ============================ */

            case 'admin':
                $controller = new \App\Controllers\AdminController();
                $controller->dashboard();
                break;

            case 'admin-users':
                $controller = new \App\Controllers\AdminController();
                $controller->users();
                break;

            case 'admin-agences':
                $controller = new \App\Controllers\AdminController();
                $controller->agences();
                break;

            case 'admin-agence-create':
                $controller = new \App\Controllers\AdminController();
                $controller->agenceCreate();
                break;

            case 'admin-agence-edit':
                $controller = new \App\Controllers\AdminController();
                $controller->agenceEdit();
                break;

            case 'admin-agence-delete':
                $controller = new \App\Controllers\AdminController();
                $controller->agenceDelete();
                break;

            case 'admin-trajets':
                $controller = new \App\Controllers\AdminController();
                $controller->trajets();
                break;

            case 'admin-trajet-delete':
                $controller = new \App\Controllers\AdminController();
                $controller->trajetDelete();
                break;


            /* ============================
               PAGE PAR DÉFAUT
            ============================ */

            default:
                $controller = new \App\Controllers\HomeController();
                $controller->index();
                break;
        }
    }
}