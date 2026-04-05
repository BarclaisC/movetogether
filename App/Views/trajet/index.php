<?php $this->title = "Mes trajets"; ?>

<h1 class="mb-4">Mes trajets</h1>

<?php if (empty($trajets)): ?>
    <p>Aucun trajet pour le moment.</p>
<?php else: ?>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Départ</th>
            <th>Arrivée</th>
            <th>Date départ</th>
            <th>Date arrivée</th>
            <th>Places totales</th>
            <th>Places dispo</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($trajets as $t): ?>
        <tr>
            <td><?= htmlspecialchars($t['depart']) ?></td>
            <td><?= htmlspecialchars($t['arrivee']) ?></td>
            <td><?= date('d/m/Y H:i', strtotime($t['date_depart'])) ?></td>
            <td><?= date('d/m/Y H:i', strtotime($t['date_arrivee'])) ?></td>
            <td><?= $t['places_total'] ?></td>
            <td><?= $t['places_disponibles'] ?></td>

            <td>
                <a href="index.php?page=trajet-edit&id=<?= $t['id'] ?>" class="btn btn-sm btn-primary">
                    Modifier
                </a>

                <a href="index.php?page=trajet-delete&id=<?= $t['id'] ?>"
                   class="btn btn-sm btn-danger"
                   onclick="return confirm('Supprimer ce trajet ?');">
                    Supprimer
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php endif; ?>