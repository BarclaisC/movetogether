<?php

namespace App\Core;

use App\Core\Auth;

class Router
{
    public function run()
    {
        Session::start();

        $page = $_GET['page'] ?? 'home';

        switch ($page) {

            /* ============================
               PAGES PUBLIQUES
            ============================ */

            case 'home':
                (new \App\Controllers\HomeController())->index();
                break;

            case 'login':
                (new \App\Controllers\AuthController())->login();
                break;

            case 'logout':
                (new \App\Controllers\AuthController())->logout();
                break;


            /* ============================
               TRAJETS (UTILISATEUR)
            ============================ */

            case 'trajets':
            case 'trajet-create':
            case 'trajet-edit':
            case 'trajet-delete':

                if (!Auth::check()) {
                    header('Location: index.php?page=login');
                    exit;
                }

                $controller = new \App\Controllers\TrajetController();

                if ($page === 'trajets') $controller->index();
                if ($page === 'trajet-create') $controller->create();
                if ($page === 'trajet-edit') $controller->edit();
                if ($page === 'trajet-delete') $controller->delete();

                break;


            /* ============================
               ADMINISTRATION
            ============================ */

            case 'admin':
            case 'admin-users':
            case 'admin-agences':
            case 'admin-agence-create':
            case 'admin-agence-edit':
            case 'admin-agence-delete':
            case 'admin-trajets':
            case 'admin-trajet-delete':

                if (!Auth::isAdmin()) {
                    header('Location: index.php?page=home');
                    exit;
                }

                $controller = new \App\Controllers\AdminController();

                if ($page === 'admin') $controller->dashboard();
                if ($page === 'admin-users') $controller->users();
                if ($page === 'admin-agences') $controller->agences();
                if ($page === 'admin-agence-create') $controller->agenceCreate();
                if ($page === 'admin-agence-edit') $controller->agenceEdit();
                if ($page === 'admin-agence-delete') $controller->agenceDelete();
                if ($page === 'admin-trajets') $controller->trajets();
                if ($page === 'admin-trajet-delete') $controller->trajetDelete();

                break;


            /* ============================
               PAGE 404
            ============================ */

            default:
                http_response_code(404);
                (new \App\Controllers\HomeController())->notFound();
                break;
        }
    }
}