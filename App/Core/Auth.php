<?php

namespace App\Core;

class Auth
{
    /**
     * Vérifie si un utilisateur est connecté
     */
    public static function check(): bool
    {
        return Session::get('user') !== null;
    }

    /**
     * Retourne l'utilisateur connecté ou null
     */
    public static function user(): ?array
    {
        $user = Session::get('user');
        return is_array($user) ? $user : null;
    }

    /**
     * Retourne l'ID de l'utilisateur connecté (optionnel)
     */
    public static function id(): ?int
    {
        return self::check() ? (int) self::user()['id'] : null;
    }

    /**
     * Vérifie si l'utilisateur est administrateur
     */
    public static function isAdmin(): bool
    {
        $user = self::user();
        return $user && isset($user['role']) && $user['role'] === 'admin';
    }

    /**
     * Déconnexion propre (optionnel mais pro)
     */
    public static function logout(): void
    {
        Session::destroy();
    }
}