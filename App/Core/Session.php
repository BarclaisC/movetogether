<?php

namespace App\Core;

class Session
{
    /**
     * Démarre la session si nécessaire
     */
    public static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Définit une valeur en session
     */
    public static function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Récupère une valeur en session
     */
    public static function get(string $key): mixed
    {
        return $_SESSION[$key] ?? null;
    }

    /**
     * Vérifie si une clé existe en session
     */
    public static function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Supprime une clé spécifique
     */
    public static function remove(string $key): void
    {
        unset($_SESSION[$key]);
    }

    /**
     * Détruit proprement toute la session
     */
    public static function destroy(): void
    {
        $_SESSION = []; // vide la session
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
    }

    /**
     * Regénère l'ID de session (sécurité)
     */
    public static function regenerate(): void
    {
        session_regenerate_id(true);
    }
}