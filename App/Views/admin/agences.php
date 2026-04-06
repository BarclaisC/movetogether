<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="m-0">Liste des agences</h1>

        <a href="index.php?page=admin-agence-create" class="btn btn-success">
            + Ajouter une agence
        </a>
    </div>

    <?php if (empty($agences)): ?>

        <div class="alert alert-info text-center">
            Aucune agence enregistrée.
        </div>

    <?php else: ?>

        <div class="table-responsive">
            <table class="table table-striped table-bordered shadow-sm align-middle">

                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th class="text-center" style="width: 180px;">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($agences as $agence): ?>
                        <tr>
                            <td><?= $agence['id'] ?></td>
                            <td><?= htmlspecialchars($agence['nom']) ?></td>

                            <td class="text-center">

                                <!-- Modifier -->
                                <a href="index.php?page=admin-agence-edit&id=<?= $agence['id'] ?>"
                                   class="btn btn-warning btn-sm me-1">
                                    ✏ Modifier
                                </a>

                                <!-- Supprimer -->
                                <a href="index.php?page=admin-agence-delete&id=<?= $agence['id'] ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Supprimer l’agence « <?= htmlspecialchars($agence['nom']) ?> » ?')">
                                    🗑 Supprimer
                                </a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>

    <?php endif; ?>

</div>