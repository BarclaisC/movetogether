<?php use App\Core\Auth; ?>

<div class="container mt-4" style="max-width: 700px;">

    <h1 class="mb-4">Proposer un trajet</h1>

    <!-- Affichage des erreurs -->
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?page=trajet-create" class="bg-white p-4 rounded shadow-sm">

        <!-- Agence de départ -->
        <div class="mb-3">
            <label class="form-label">Agence de départ</label>
            <select name="agence_depart_id" class="form-select" required>
                <option value="">Sélectionner...</option>
                <?php foreach ($agences as $agence): ?>
                    <option value="<?= $agence['id'] ?>">
                        <?= htmlspecialchars($agence['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Agence d'arrivée -->
        <div class="mb-3">
            <label class="form-label">Agence d'arrivée</label>
            <select name="agence_arrivee_id" class="form-select" required>
                <option value="">Sélectionner...</option>
                <?php foreach ($agences as $agence): ?>
                    <option value="<?= $agence['id'] ?>">
                        <?= htmlspecialchars($agence['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Date de départ -->
        <div class="mb-3">
            <label class="form-label">Date de départ</label>
            <input 
                type="datetime-local" 
                name="date_depart" 
                class="form-control"
                required
            >
        </div>

        <!-- Date d'arrivée -->
        <div class="mb-3">
            <label class="form-label">Date d'arrivée</label>
            <input 
                type="datetime-local" 
                name="date_arrivee" 
                class="form-control"
                required
            >
        </div>

        <!-- Nombre de places -->
        <div class="mb-3">
            <label class="form-label">Nombre total de places</label>
            <input 
                type="number" 
                name="places_total" 
                class="form-control"
                min="1"
                required
            >
        </div>

        <!-- Bouton -->
        <button type="submit" class="btn btn-primary w-100">
            Créer le trajet
        </button>

    </form>

</div>