<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Models\Trajet;
use App\Models\Agence;

class TrajetController extends Controller
{
    /**
     * Page principale des trajets (utilisateurs)
     */
    public function index()
    {
        if (!Auth::check()) {
            header('Location: index.php?page=login');
            exit;
        }

        $trajets = (new Trajet())->getAllWithAgences();

        $this->render('trajet/index', [
            'trajets' => $trajets
        ]);
    }

    public function create()
    {
        if (!Auth::check()) {
            header('Location: index.php?page=login');
            exit;
        }

        $agences = (new Agence())->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $errors = $this->validateTrajet($_POST);

            if (empty($errors)) {
                (new Trajet())->create($_POST, Auth::user()['id']);
                header('Location: index.php?page=trajets');
                exit;
            }

            $this->render('trajet/create', [
                'agences' => $agences,
                'errors' => $errors
            ]);
            return;
        }

        $this->render('trajet/create', [
            'agences' => $agences
        ]);
    }

    public function edit()
    {
        if (!Auth::check()) {
            header('Location: index.php?page=login');
            exit;
        }

        $id = $_GET['id'] ?? null;
        $trajetModel = new Trajet();
        $trajet = $trajetModel->find($id);

        if (!$trajet || $trajet['user_id'] != Auth::user()['id']) {
            die("Accès non autorisé");
        }

        $agences = (new Agence())->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $errors = $this->validateTrajet($_POST);

            if (empty($errors)) {
                $trajetModel->update($id, $_POST);
                header('Location: index.php?page=trajets');
                exit;
            }

            $this->render('trajet/edit', [
                'trajet' => $trajet,
                'agences' => $agences,
                'errors' => $errors
            ]);
            return;
        }

        $this->render('trajet/edit', [
            'trajet' => $trajet,
            'agences' => $agences
        ]);
    }

    public function delete()
    {
        if (!Auth::check()) {
            header('Location: index.php?page=login');
            exit;
        }

        $id = $_GET['id'] ?? null;

        $trajetModel = new Trajet();
        $trajet = $trajetModel->find($id);

        if (!$trajet || $trajet['user_id'] != Auth::user()['id']) {
            die("Accès non autorisé");
        }

        $trajetModel->delete($id);
        header('Location: index.php?page=trajets');
    }

    private function validateTrajet(array $data): array
    {
        $errors = [];

        if ($data['agence_depart_id'] === $data['agence_arrivee_id']) {
            $errors[] = "L'agence de départ et d'arrivée doivent être différentes.";
        }

        if (strtotime($data['date_depart']) >= strtotime($data['date_arrivee'])) {
            $errors[] = "La date d'arrivée doit être postérieure à la date de départ.";
        }

        if ($data['places_total'] <= 0) {
            $errors[] = "Le nombre total de places doit être supérieur à 0.";
        }

        return $errors;
    }
}