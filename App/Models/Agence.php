<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Agence
{
    /**
     * Récupère toutes les agences (triées par ordre alphabétique)
     */
    public function getAll(): array
    {
        $pdo = Database::getConnection();

        $sql = "SELECT * FROM agences ORDER BY nom ASC";

        return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère une agence par son ID
     */
    public function find(int $id): ?array
    {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare("SELECT * FROM agences WHERE id = ?");
        $stmt->execute([$id]);

        $agence = $stmt->fetch(PDO::FETCH_ASSOC);

        return $agence ?: null;
    }

    /**
     * Création d’une agence (admin)
     */
    public function create(string $nom): bool
    {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare("INSERT INTO agences (nom) VALUES (?)");

        return $stmt->execute([$nom]);
    }

    /**
     * Mise à jour d’une agence (admin)
     */
    public function update(int $id, string $nom): bool
    {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare("UPDATE agences SET nom = ? WHERE id = ?");

        return $stmt->execute([$nom, $id]);
    }

    /**
     * Suppression d’une agence (admin)
     */
    public function delete(int $id): bool
    {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare("DELETE FROM agences WHERE id = ?");

        return $stmt->execute([$id]);
    }
}