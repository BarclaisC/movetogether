<div class="container mt-4" style="max-width: 600px;">

    <h1 class="mb-4">Ajouter une agence</h1>

    <!-- Affichage des erreurs -->
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?page=admin-agence-create" class="bg-white p-4 rounded shadow-sm">

        <div class="mb-3">
            <label for="nom" class="form-label">Nom de l'agence</label>
            <input 
                type="text" 
                name="nom" 
                id="nom" 
                class="form-control"
                placeholder="Ex : Paris Gare de Lyon"
                required
            >
        </div>

        <button type="submit" class="btn btn-success w-100">
            Ajouter l'agence
        </button>

    </form>

</div>