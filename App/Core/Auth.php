<?php

namespace App\Core;

class Auth
{
    public static function check(): bool
    {
        return Session::get('user') !== null;
    }

    public static function user(): ?array
    {
        return Session::get('user');
    }

    public static function isAdmin(): bool
    {
        return self::check() && self::user()['role'] === 'admin';
    }
}