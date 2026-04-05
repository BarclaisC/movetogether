<?php use App\Core\Auth; ?>

<div class="container mt-4" style="max-width: 700px;">

    <h1 class="mb-4">Modifier le trajet</h1>

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

    <form method="POST" action="index.php?page=trajet-edit&id=<?= $trajet['id'] ?>" class="bg-white p-4 rounded shadow-sm">

        <!-- Agence de départ -->
        <div class="mb-3">
            <label class="form-label">Agence de départ</label>
            <select name="agence_depart_id" class="form-select" required>
                <?php foreach ($agences as $agence): ?>
                    <option 
                        value="<?= $agence['id'] ?>"
                        <?= $agence['id'] == $trajet['agence_depart_id'] ? 'selected' : '' ?>
                    >
                        <?= htmlspecialchars($agence['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Agence d'arrivée -->
        <div class="mb-3">
            <label class="form-label">Agence d'arrivée</label>
            <select name="agence_arrivee_id" class="form-select" required>
                <?php foreach ($agences as $agence): ?>
                    <option 
                        value="<?= $agence['id'] ?>"
                        <?= $agence['id'] == $trajet['agence_arrivee_id'] ? 'selected' : '' ?>
                    >
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
                value="<?= date('Y-m-d\TH:i', strtotime($trajet['date_depart'])) ?>"
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
                value="<?= date('Y-m-d\TH:i', strtotime($trajet['date_arrivee'])) ?>"
                required
            >
        </div>

        <!-- Nombre total de places -->
        <div class="mb-3">
            <label class="form-label">Nombre total de places</label>
            <input 
                type="number" 
                name="places_total" 
                class="form-control"
                min="1"
                value="<?= $trajet['places_total'] ?>"
                required
            >
        </div>

        <!-- Places disponibles -->
        <div class="mb-3">
            <label class="form-label">Places disponibles</label>
            <input 
                type="number" 
                name="places_disponibles" 
                class="form-control"
                min="0"
                max="<?= $trajet['places_total'] ?>"
                value="<?= $trajet['places_disponibles'] ?>"
                required
            >
        </div>

        <!-- Bouton -->
        <button type="submit" class="btn btn-primary w-100">
            Enregistrer les modifications
        </button>

    </form>

</div>