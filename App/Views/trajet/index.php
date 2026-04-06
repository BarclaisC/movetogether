<?php $this->title = "Mes trajets"; ?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="m-0">Mes trajets</h1>

        <a href="index.php?page=trajet-create" class="btn btn-success">
            + Ajouter un trajet
        </a>
    </div>

    <?php if (empty($trajets)): ?>

        <div class="alert alert-info text-center">
            Aucun trajet pour le moment.
        </div>

    <?php else: ?>

        <div class="table-responsive">
            <table class="table table-striped table-bordered shadow-sm align-middle">

                <thead class="table-primary">
                    <tr>
                        <th>Départ</th>
                        <th>Arrivée</th>
                        <th>Date départ</th>
                        <th>Date arrivée</th>
                        <th>Places totales</th>
                        <th>Places dispo</th>
                        <th class="text-center" style="width: 160px;">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($trajets as $t): ?>
                        <tr>
                            <td><?= htmlspecialchars($t['depart']) ?></td>
                            <td><?= htmlspecialchars($t['arrivee']) ?></td>

                            <td><?= date('d/m/Y H:i', strtotime($t['date_depart'])) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($t['date_arrivee'])) ?></td>

                            <td>
                                <span class="badge bg-secondary">
                                    <?= $t['places_total'] ?>
                                </span>
                            </td>

                            <td>
                                <span class="badge bg-success">
                                    <?= $t['places_disponibles'] ?>
                                </span>
                            </td>

                            <td class="text-center">

                                <!-- Modifier -->
                                <a href="index.php?page=trajet-edit&id=<?= $t['id'] ?>"
                                   class="btn btn-primary btn-sm me-1">
                                    ✏ Modifier
                                </a>

                                <!-- Supprimer -->
                                <a href="index.php?page=trajet-delete&id=<?= $t['id'] ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Supprimer le trajet <?= htmlspecialchars($t['depart']) ?> → <?= htmlspecialchars($t['arrivee']) ?> ?');">
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