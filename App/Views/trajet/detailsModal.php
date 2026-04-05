<div class="modal" id="trajetDetailsModal">
    <div class="modal-content">

        <span class="close-modal" onclick="closeModal()">&times;</span>

        <h2>Détails du trajet</h2>

        <p><strong>Départ :</strong> <?= $trajet['depart'] ?></p>
        <p><strong>Arrivée :</strong> <?= $trajet['arrivee'] ?></p>

        <p><strong>Date de départ :</strong> <?= $trajet['date_depart'] ?></p>
        <p><strong>Date d'arrivée :</strong> <?= $trajet['date_arrivee'] ?></p>

        <p><strong>Places disponibles :</strong> <?= $trajet['places_disponibles'] ?></p>

        <h3>Conducteur</h3>
        <p><?= $trajet['prenom'] ?> <?= $trajet['nom'] ?></p>
        <p><strong>Email :</strong> <?= $trajet['email'] ?></p>
        <p><strong>Téléphone :</strong> <?= $trajet['telephone'] ?></p>

        <button onclick="closeModal()">Fermer</button>
    </div>
</div>

<style>
.modal {
    display: none; 
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.5);
}

.modal-content {
    background: white;
    padding: 20px;
    width: 400px;
    margin: 10% auto;
    border-radius: 8px;
}

.close-modal {
    float: right;
    cursor: pointer;
    font-size: 24px;
}
</style>

<script>
function openModal() {
    document.getElementById('trajetDetailsModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('trajetDetailsModal').style.display = 'none';
}
</script>