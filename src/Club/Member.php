<?php

declare(strict_types=1);

namespace App\Club;

use App\Auth\AuthException;

interface Member
{
    /**
     * @throws AuthException If authentication fails
     */
    public function auth(
        string $login,
        string $password,
    ): void;

    public function getName(): string;

    public function __toString(): string;
}
