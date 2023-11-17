<?php

namespace App;

enum Level: string
{
    case Admin = 'admin';
    case SuperAdmin = 'superadmin';

    public function label(): string
    {
        return match($this) {
            self::Admin => 'Admin',
            self::SuperAdmin => 'Super Admin 3000 ++',
        };
    }
}
