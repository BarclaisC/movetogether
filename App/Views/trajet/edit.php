<?php $this->title = "Modifier un trajet"; ?>

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
                        <?= (isset($_POST['agence_depart_id']) ? $_POST['agence_depart_id'] : $trajet['agence_depart_id']) == $agence['id'] ? 'selected' : '' ?>
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
                        <?= (isset($_POST['agence_arrivee_id']) ? $_POST['agence_arrivee_id'] : $trajet['agence_arrivee_id']) == $agence['id'] ? 'selected' : '' ?>
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
                value="<?= isset($_POST['date_depart']) ? $_POST['date_depart'] : date('Y-m-d\TH:i', strtotime($trajet['date_depart'])) ?>"
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
                value="<?= isset($_POST['date_arrivee']) ? $_POST['date_arrivee'] : date('Y-m-d\TH:i', strtotime($trajet['date_arrivee'])) ?>"
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
                value="<?= isset($_POST['places_total']) ? $_POST['places_total'] : htmlspecialchars($trajet['places_total']) ?>"
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
                max="<?= htmlspecialchars($trajet['places_total']) ?>"
                value="<?= isset($_POST['places_disponibles']) ? $_POST['places_disponibles'] : htmlspecialchars($trajet['places_disponibles']) ?>"
                required
            >
        </div>

        <!-- Boutons -->
        <div class="d-flex gap-2">
            <a href="index.php?page=trajets" class="btn btn-secondary w-50">
                ← Retour
            </a>

            <button type="submit" class="btn btn-primary w-50">
                💾 Enregistrer
            </button>
        </div>

    </form>

</div>