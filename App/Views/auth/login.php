<div class="container mt-4" style="max-width: 500px;">

    <h1 class="mb-4 text-center">Connexion</h1>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?page=login" class="bg-white p-4 rounded shadow-sm">

        <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input 
                type="email" 
                name="email" 
                id="email" 
                class="form-control"
                placeholder="exemple@entreprise.com"
                required
            >
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input 
                type="password" 
                name="password" 
                id="password" 
                class="form-control"
                placeholder="Votre mot de passe"
                required
            >
        </div>

        <button type="submit" class="btn btn-primary w-100">
            Se connecter
        </button>

    </form>

</div>