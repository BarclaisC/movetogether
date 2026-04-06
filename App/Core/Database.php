<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $pdo = null;

    // Empêche l'instanciation
    private function __construct() {}
    private function __clone() {}

    public static function getConnection(): PDO
    {
        if (self::$pdo === null) {

            require __DIR__ . '/../../config/config.php';

            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";

            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            try {
                self::$pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
            } catch (PDOException $e) {
                // Message propre sans fuite d'informations sensibles
                die("Erreur de connexion à la base de données.");
            }
        }

        return self::$pdo;
    }
}