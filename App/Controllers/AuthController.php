<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Connexion utilisateur
     */
    public function login()
    {
        // Déjà connecté → redirection selon rôle
        if (Session::get('user')) {
            $user = Session::get('user');

            if ($user['role'] === 'admin') {
                header('Location: index.php?page=admin');
            } else {
                header('Location: index.php?page=trajets');
            }
            exit;
        }

        // Traitement du formulaire
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = strtolower(trim($_POST['email'] ?? ''));
            $password = trim($_POST['password'] ?? '');

            // Vérification des champs obligatoires
            if (empty($email) || empty($password)) {
                $this->render('auth/login', [
                    'error' => 'Veuillez remplir tous les champs.',
                    'email' => $email
                ]);
                return;
            }

            // Tentative de connexion
            $user = (new User())->login($email, $password);

            if ($user) {
                Session::set('user', $user);

                // Redirection selon rôle
                if ($user['role'] === 'admin') {
                    header('Location: index.php?page=admin');
                } else {
                    header('Location: index.php?page=trajets');
                }
                exit;
            }

            // Identifiants incorrects
            $this->render('auth/login', [
                'error' => 'Identifiants incorrects.',
                'email' => $email
            ]);
            return;
        }

        // Affichage du formulaire
        $this->render('auth/login');
    }

    /**
     * Déconnexion
     */
    public function logout()
    {
        Session::destroy();
        header('Location: index.php?page=login');
        exit;
    }
}