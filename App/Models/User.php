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
        $email = strtolower(trim($email));

        if ($email === '' || $password === '') {
            return null;
        }

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
        if (!$id) {
            return null;
        }

        $pdo = Database::getConnection();

        $stmt = $pdo->prepare("
            SELECT id, nom, prenom, email, telephone, role 
            FROM users 
            WHERE id = ?
        ");
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

        $sql = "
            SELECT id, nom, prenom, email, telephone, role 
            FROM users 
            ORDER BY nom ASC
        ";

        return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Création d’un utilisateur 
     */
    public function create(array $data): bool
    {
        $pdo = Database::getConnection();

        $nom = trim($data['nom']);
        $prenom = trim($data['prenom']);
        $email = strtolower(trim($data['email']));
        $telephone = trim($data['telephone']);
        $password = trim($data['password']);
        $role = $data['role'] ?? 'user';

        if ($nom === '' || $prenom === '' || $email === '' || $password === '') {
            return false;
        }

        $sql = "
            INSERT INTO users (nom, prenom, email, telephone, password, role)
            VALUES (?, ?, ?, ?, ?, ?)
        ";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            $nom,
            $prenom,
            $email,
            $telephone,
            password_hash($password, PASSWORD_DEFAULT),
            $role
        ]);
    }
}