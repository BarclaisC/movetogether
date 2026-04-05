<?php

namespace App\Models;

use App\Core\Database;
use App\Core\Auth;   // ⭐ nécessaire pour récupérer l'utilisateur connecté
use PDO;

class Trajet
{
    /**
     * Récupère tous les trajets disponibles (places > 0 et date future)
     */
    public function getAvailable(): array
    {
        $pdo = Database::getConnection();

        $sql = "SELECT t.*, 
                       a1.nom AS depart, 
                       a2.nom AS arrivee,
                       u.prenom, u.nom, u.telephone, u.email
                FROM trajets t
                JOIN agences a1 ON t.agence_depart_id = a1.id
                JOIN agences a2 ON t.agence_arrivee_id = a2.id
                JOIN users u ON t.user_id = u.id
                WHERE t.places_disponibles > 0
                AND t.date_depart > NOW()
                ORDER BY t.date_depart ASC";

        return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un trajet par son ID
     */
    public function find(int $id): ?array
    {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare("SELECT * FROM trajets WHERE id = ?");
        $stmt->execute([$id]);

        $trajet = $stmt->fetch(PDO::FETCH_ASSOC);

        return $trajet ?: null;
    }

    /**
     * Création d’un trajet
     */
    public function create(array $data, int $userId): bool
    {
        $pdo = Database::getConnection();

        $sql = "INSERT INTO trajets 
                (agence_depart_id, agence_arrivee_id, date_depart, date_arrivee, 
                 places_total, places_disponibles, user_id)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            $data['agence_depart_id'],
            $data['agence_arrivee_id'],
            $data['date_depart'],
            $data['date_arrivee'],
            $data['places_total'],
            $data['places_total'], // places dispo = total au départ
            $userId
        ]);
    }

    /**
     * Mise à jour d’un trajet
     */
    public function update(int $id, array $data): bool
    {
        $pdo = Database::getConnection();

        $sql = "UPDATE trajets SET 
                    agence_depart_id = ?, 
                    agence_arrivee_id = ?, 
                    date_depart = ?, 
                    date_arrivee = ?, 
                    places_total = ?, 
                    places_disponibles = ?
                WHERE id = ?";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            $data['agence_depart_id'],
            $data['agence_arrivee_id'],
            $data['date_depart'],
            $data['date_arrivee'],
            $data['places_total'],
            $data['places_disponibles'],
            $id
        ]);
    }

    /**
     * Suppression d’un trajet
     */
    public function delete(int $id): bool
    {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare("DELETE FROM trajets WHERE id = ?");
        return $stmt->execute([$id]);
    }

    /**
     * Récupère tous les trajets (admin)
     */
    public function getAll(): array
    {
        $pdo = Database::getConnection();

        $sql = "SELECT t.*, 
                       a1.nom AS depart, 
                       a2.nom AS arrivee,
                       u.prenom, u.nom
                FROM trajets t
                JOIN agences a1 ON t.agence_depart_id = a1.id
                JOIN agences a2 ON t.agence_arrivee_id = a2.id
                JOIN users u ON t.user_id = u.id
                ORDER BY t.date_depart DESC";

        return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * ⭐ Récupère les trajets de l'utilisateur connecté
     */
    public function getAllWithAgences(): array
    {
        $pdo = Database::getConnection();

        $sql = "
            SELECT t.*, 
                   a1.nom AS depart,
                   a2.nom AS arrivee
            FROM trajets t
            JOIN agences a1 ON t.agence_depart_id = a1.id
            JOIN agences a2 ON t.agence_arrivee_id = a2.id
            WHERE t.user_id = ?
            ORDER BY t.date_depart ASC
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([Auth::user()['id']]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}