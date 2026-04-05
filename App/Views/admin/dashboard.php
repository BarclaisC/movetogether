<?php
// Sécurisation : accès réservé aux administrateurs
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: index.php?page=login');
    exit;
}
?>

<div class="container mt-4">

    <h1 class="mb-4">Tableau de bord administrateur</h1>

    <div class="row g-4">

        <!-- Carte Utilisateurs -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body text-center">

                    <h5 class="card-title mb-3">Utilisateurs</h5>

                    <p class="card-text text-muted">
                        Gérer la liste des employés (lecture seule).
                    </p>

                    <a href="index.php?page=admin-users" class="btn btn-primary w-100">
                        Voir les utilisateurs
                    </a>

                </div>
            </div>
        </div>

        <!-- Carte Agences -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body text-center">

                    <h5 class="card-title mb-3">Agences</h5>

                    <p class="card-text text-muted">
                        Ajouter, modifier ou supprimer une agence.
                    </p>

                    <a href="index.php?page=admin-agences" class="btn btn-primary w-100">
                        Gérer les agences
                    </a>

                </div>
            </div>
        </div>

        <!-- Carte Trajets -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body text-center">

                    <h5 class="card-title mb-3">Trajets</h5>

                    <p class="card-text text-muted">
                        Consulter et supprimer les trajets proposés.
                    </p>

                    <a href="index.php?page=admin-trajets" class="btn btn-primary w-100">
                        Gérer les trajets
                    </a>

                </div>
            </div>
        </div>

    </div>

</div>