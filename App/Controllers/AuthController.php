<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        // Si déjà connecté → redirection selon rôle
        if (Session::get('user')) {
            $user = Session::get('user');

            if ($user['role'] === 'admin') {
                header('Location: index.php?page=admin');
            } else {
                header('Location: index.php?page=trajets');
            }
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Nettoyage des entrées
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $user = (new User())->login($email, $password);

            if ($user) {
                Session::set('user', $user);

                // 🔥 Redirection selon le rôle
                if ($user['role'] === 'admin') {
                    header('Location: index.php?page=admin');
                } else {
                    header('Location: index.php?page=trajets');
                }
                exit;
            }

            // Erreur → renvoi du formulaire
            $this->render('auth/login', [
                'error' => 'Identifiants incorrects'
            ]);
            return;
        }

        // Affichage du formulaire
        $this->render('auth/login');
    }

    public function logout()
    {
        Session::destroy();
        header('Location: index.php?page=login');
        exit;
    }
}