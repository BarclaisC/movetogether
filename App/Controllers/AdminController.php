<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Models\Agence;
use App\Models\Trajet;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        // Protection ADMIN propre
        if (!Auth::isAdmin()) {
            header('Location: index.php?page=home');
            exit;
        }
    }

    /**
     * Tableau de bord principal
     */
    public function dashboard()
    {
        $this->render('admin/dashboard');
    }

    /**
     * Liste des utilisateurs
     */
    public function users()
    {
        $users = (new User())->getAll();

        $this->render('admin/users', [
            'users' => $users
        ]);
    }

    /**
     * Liste des agences
     */
    public function agences()
    {
        $agences = (new Agence())->getAll();

        $this->render('admin/agences', [
            'agences' => $agences
        ]);
    }

    /**
     * Création d’une agence
     */
    public function agenceCreate()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (empty($_POST['nom'])) {
                $this->render('admin/agenceCreate', [
                    'error' => "Le nom de l'agence est obligatoire."
                ]);
                return;
            }

            (new Agence())->create($_POST['nom']);

            header('Location: index.php?page=admin-agences');
            exit;
        }

        $this->render('admin/agenceCreate');
    }

    /**
     * Modification d’une agence
     */
    public function agenceEdit()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('Location: index.php?page=admin-agences');
            exit;
        }

        $agenceModel = new Agence();
        $agence = $agenceModel->find($id);

        if (!$agence) {
            header('Location: index.php?page=admin-agences');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (empty($_POST['nom'])) {
                $this->render('admin/agenceEdit', [
                    'agence' => $agence,
                    'error' => "Le nom de l'agence est obligatoire."
                ]);
                return;
            }

            $agenceModel->update($id, $_POST['nom']);

            header('Location: index.php?page=admin-agences');
            exit;
        }

        $this->render('admin/agenceEdit', [
            'agence' => $agence
        ]);
    }

    /**
     * Suppression d’une agence
     */
    public function agenceDelete()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('Location: index.php?page=admin-agences');
            exit;
        }

        $agenceModel = new Agence();
        $agence = $agenceModel->find($id);

        if (!$agence) {
            header('Location: index.php?page=admin-agences');
            exit;
        }

        $agenceModel->delete($id);

        header('Location: index.php?page=admin-agences');
        exit;
    }

    /**
     * Liste des trajets
     */
    public function trajets()
    {
        $trajets = (new Trajet())->getAll();

        $this->render('admin/trajets', [
            'trajets' => $trajets
        ]);
    }

    /**
     * Suppression d’un trajet
     */
    public function trajetDelete()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('Location: index.php?page=admin-trajets');
            exit;
        }

        $trajetModel = new Trajet();
        $trajet = $trajetModel->find($id);

        if (!$trajet) {
            header('Location: index.php?page=admin-trajets');
            exit;
        }

        $trajetModel->delete($id);

        header('Location: index.php?page=admin-trajets');
        exit;
    }
}