<div class="container mt-4">

    <h1 class="mb-4">Liste des utilisateurs</h1>

    <?php if (empty($users)): ?>

        <div class="alert alert-info text-center">
            Aucun utilisateur trouvé.
        </div>

    <?php else: ?>

        <div class="table-responsive">
            <table class="table table-striped table-bordered shadow-sm align-middle">

                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Rôle</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><?= htmlspecialchars($user['nom']) ?></td>
                            <td><?= htmlspecialchars($user['prenom']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= htmlspecialchars($user['telephone']) ?></td>

                            <td>
                                <span class="badge bg-<?= $user['role'] === 'admin' ? 'danger' : 'secondary' ?>">
                                    <?= htmlspecialchars($user['role']) ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>

    <?php endif; ?>

</div>