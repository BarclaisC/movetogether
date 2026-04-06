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

    /**
     * Création d’un trajet
     */
    public function create()
    {
        if (!Auth::check()) {
            header('Location: index.php?page=login');
            exit;
        }

        $agences = (new Agence())->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'agence_depart_id' => trim($_POST['agence_depart_id']),
                'agence_arrivee_id' => trim($_POST['agence_arrivee_id']),
                'date_depart' => trim($_POST['date_depart']),
                'date_arrivee' => trim($_POST['date_arrivee']),
                'places_total' => trim($_POST['places_total'])
            ];

            $errors = $this->validateTrajet($data);

            if (empty($errors)) {
                (new Trajet())->create($data, Auth::user()['id']);
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

    /**
     * Modification d’un trajet
     */
    public function edit()
    {
        if (!Auth::check()) {
            header('Location: index.php?page=login');
            exit;
        }

        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('Location: index.php?page=trajets');
            exit;
        }

        $trajetModel = new Trajet();
        $trajet = $trajetModel->find($id);

        if (!$trajet || $trajet['user_id'] != Auth::user()['id']) {
            header('Location: index.php?page=trajets');
            exit;
        }

        $agences = (new Agence())->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'agence_depart_id' => trim($_POST['agence_depart_id']),
                'agence_arrivee_id' => trim($_POST['agence_arrivee_id']),
                'date_depart' => trim($_POST['date_depart']),
                'date_arrivee' => trim($_POST['date_arrivee']),
                'places_total' => trim($_POST['places_total'])
            ];

            $errors = $this->validateTrajet($data);

            if (empty($errors)) {
                $trajetModel->update($id, $data);
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

    /**
     * Suppression d’un trajet
     */
    public function delete()
    {
        if (!Auth::check()) {
            header('Location: index.php?page=login');
            exit;
        }

        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('Location: index.php?page=trajets');
            exit;
        }

        $trajetModel = new Trajet();
        $trajet = $trajetModel->find($id);

        if (!$trajet || $trajet['user_id'] != Auth::user()['id']) {
            header('Location: index.php?page=trajets');
            exit;
        }

        $trajetModel->delete($id);

        header('Location: index.php?page=trajets');
        exit;
    }

    /**
     * Validation des données d’un trajet
     */
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