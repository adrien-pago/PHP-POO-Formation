<?php

declare(strict_types=1); // Activation stricte du typage.

namespace App\Club;

use App\Auth\AuthException;

interface Member // Déclaration d'une interface.
{
    /**
     * Méthode pour authentifier le membre.
     * @throws AuthException Si l'authentification échoue.
     */
    public function auth(
        string $login,
        string $password,
    ): void;

    public function getName(): string; // Méthode pour obtenir le nom du membre.

    public function __toString(): string; // Méthode pour la représentation sous forme de chaîne.
}
