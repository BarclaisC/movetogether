<div class="container mt-4">

    <h1 class="mb-4">Liste des trajets</h1>

    <?php if (empty($trajets)): ?>

        <div class="alert alert-info text-center">
            Aucun trajet enregistré.
        </div>

    <?php else: ?>

        <div class="table-responsive">
            <table class="table table-striped table-bordered shadow-sm align-middle">

                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Départ</th>
                        <th>Arrivée</th>
                        <th>Date départ</th>
                        <th>Date arrivée</th>
                        <th>Conducteur</th>
                        <th>Places totales</th>
                        <th>Places dispo</th>
                        <th class="text-center" style="width: 150px;">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($trajets as $trajet): ?>
                        <tr>
                            <td><?= $trajet['id'] ?></td>

                            <td><?= htmlspecialchars($trajet['depart']) ?></td>
                            <td><?= htmlspecialchars($trajet['arrivee']) ?></td>

                            <td><?= date('d/m/Y H:i', strtotime($trajet['date_depart'])) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($trajet['date_arrivee'])) ?></td>

                            <td>
                                <?= htmlspecialchars($trajet['prenom'] . ' ' . $trajet['nom']) ?>
                            </td>

                            <td><?= $trajet['places_total'] ?></td>
                            <td><?= $trajet['places_disponibles'] ?></td>

                            <td class="text-center">

                                <a href="index.php?page=admin-trajet-delete&id=<?= $trajet['id'] ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Supprimer ce trajet ?')">
                                    Supprimer
                                </a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>

    <?php endif; ?>

</div>