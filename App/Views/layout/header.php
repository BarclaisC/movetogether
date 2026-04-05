<?php use App\Core\Auth; ?>

<header class="bg-primary text-white p-3 mb-4">

    <div class="container d-flex justify-content-between align-items-center">

        <!-- Logo -->
        <div class="h4 m-0">
            <?php if (Auth::isAdmin()): ?>
                <a href="index.php?page=admin" class="text-white text-decoration-none">
                    MoveTogether
                </a>
            <?php else: ?>
                <span>MoveTogether</span>
            <?php endif; ?>
        </div>

        <!-- Bouton burger (mobile) -->
        <button class="burger d-md-none" onclick="toggleMenu()">
            ☰
        </button>

        <!-- Navigation -->
        <nav id="navLinks" class="d-flex align-items-center gap-3 flex-column flex-md-row mobile-menu">

            <?php if (!Auth::check()): ?>

                <!-- Visiteur -->
                <a href="index.php?page=login" class="btn btn-light w-100 w-md-auto">
                    Connexion
                </a>

            <?php elseif (Auth::isAdmin()): ?>

                <!-- Administrateur -->
                <a href="index.php?page=admin-users" class="btn btn-light w-100 w-md-auto">Utilisateurs</a>
                <a href="index.php?page=admin-agences" class="btn btn-light w-100 w-md-auto">Agences</a>
                <a href="index.php?page=admin-trajets" class="btn btn-light w-100 w-md-auto">Trajets</a>

                <a href="index.php?page=logout" class="btn btn-danger w-100 w-md-auto">
                    Déconnexion
                </a>

            <?php else: ?>

                <!-- Utilisateur connecté -->
                <a href="index.php?page=trajet-create" class="btn btn-light w-100 w-md-auto">
                    Proposer un trajet
                </a>

                <span class="fw-bold text-center text-md-start">
                    <?= Auth::user()['prenom'] . ' ' . Auth::user()['nom'] ?>
                </span>

                <a href="index.php?page=logout" class="btn btn-danger w-100 w-md-auto">
                    Déconnexion
                </a>

            <?php endif; ?>

        </nav>

    </div>
</header>