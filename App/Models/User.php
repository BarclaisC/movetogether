<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class User
{
    /**
     * Connexion d’un utilisateur
     */
    public function login(string $email, string $password): ?array
    {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            unset($user['password']); // sécurité
            return $user;
        }

        return null;
    }

    /**
     * Récupère un utilisateur par son ID
     */
    public function find(int $id): ?array
    {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare("SELECT id, nom, prenom, email, telephone, role 
                               FROM users WHERE id = ?");
        $stmt->execute([$id]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;
    }

    /**
     * Récupère tous les utilisateurs (admin)
     */
    public function getAll(): array
    {
        $pdo = Database::getConnection();

        $sql = "SELECT id, nom, prenom, email, telephone, role 
                FROM users 
                ORDER BY nom ASC";

        return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Création d’un utilisateur (optionnel, utile pour seed.sql)
     */
    public function create(array $data): bool
    {
        $pdo = Database::getConnection();

        $sql = "INSERT INTO users (nom, prenom, email, telephone, password, role)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            $data['nom'],
            $data['prenom'],
            $data['email'],
            $data['telephone'],
            password_hash($data['password'], PASSWORD_DEFAULT),
            $data['role'] ?? 'user'
        ]);
    }
}