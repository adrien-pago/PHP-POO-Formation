<?php

namespace App; // Déclaration de l'espace de nom.

enum Level: string // Définition d'une énumération.
{
    case Admin = 'admin'; // Valeurs de l'énumération.
    case SuperAdmin = 'superadmin';

    public function label(): string // Méthode de l'énumération.
    {
        return match($this) {
            self::Admin => 'Admin',
            self::SuperAdmin => 'Super Admin 3000 ++',
        };
    }
}
