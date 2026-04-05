<?php use App\Core\Auth; ?>

<div class="container mt-4">

    <h1 class="mb-4">Trajets disponibles</h1>

    <?php if (empty($trajets)): ?>

        <div class="alert alert-info text-center">
            Aucun trajet disponible pour le moment.
        </div>

    <?php else: ?>

        <div class="row g-4">

            <?php foreach ($trajets as $trajet): ?>
                <div class="col-md-6 col-lg-4">

                    <div class="card shadow-sm h-100">

                        <div class="card-body">

                            <h5 class="card-title">
                                <?= htmlspecialchars($trajet['depart']) ?>
                                →
                                <?= htmlspecialchars($trajet['arrivee']) ?>
                            </h5>

                            <p class="mb-1">
                                <strong>Départ :</strong>
                                <?= date('d/m/Y H:i', strtotime($trajet['date_depart'])) ?>
                            </p>

                            <p class="mb-1">
                                <strong>Arrivée :</strong>
                                <?= date('d/m/Y H:i', strtotime($trajet['date_arrivee'])) ?>
                            </p>

                            <p class="mb-3">
                                <strong>Places disponibles :</strong>
                                <?= $trajet['places_disponibles'] ?>
                            </p>

                            <!-- Bouton détails -->
                            <button 
                                class="btn btn-primary btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#detailsModal<?= $trajet['id'] ?>">
                                Détails
                            </button>

                            <!-- Boutons auteur -->
                            <?php if (Auth::check() && Auth::user()['id'] == $trajet['user_id']): ?>

                                <a href="index.php?page=trajet-edit&id=<?= $trajet['id'] ?>" 
                                   class="btn btn-warning btn-sm">
                                    Modifier
                                </a>

                                <a href="index.php?page=trajet-delete&id=<?= $trajet['id'] ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Supprimer ce trajet ?')">
                                    Supprimer
                                </a>

                            <?php endif; ?>

                        </div>
                    </div>
                </div>

                <!-- Modale détails -->
                <div class="modal fade" id="detailsModal<?= $trajet['id'] ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">Détails du trajet</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">

                                <p><strong>Conducteur :</strong>
                                    <?= htmlspecialchars($trajet['prenom'] . ' ' . $trajet['nom']) ?>
                                </p>

                                <p><strong>Téléphone :</strong>
                                    <?= htmlspecialchars($trajet['telephone']) ?>
                                </p>

                                <p><strong>Email :</strong>
                                    <?= htmlspecialchars($trajet['email']) ?>
                                </p>

                                <p><strong>Places totales :</strong>
                                    <?= $trajet['places_total'] ?>
                                </p>

                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">
                                    Fermer
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>

</div>