<?php

namespace App\Club;

use App\Auth\AuthException;
use Throwable;

class CachedMember implements Member // Implémentation de l'interface Member.
{
    private bool|null $succeeded = null; // Cache le résultat de l'authentification précédente.

    public function __construct(
        private readonly Member $member, // Composition: CachedMember "a un" Member.
    ) {
    }

    public function auth(string $login, string $password): void
    {
        if (false === $this->succeeded) {
            throw AuthException::invalidCredentials(); // Lance une exception si l'authentification a déjà échoué.
        } elseif (true === $this->succeeded) {
            return; // Retourne immédiatement si l'authentification a déjà réussi.
        }

        try {
            $this->member->auth($login, $password); // Tente d'authentifier le membre.
            $this->succeeded = true; // Marque le succès pour les futures tentatives.
        } catch (Throwable $e) {
            $this->succeeded = false; // Marque l'échec pour les futures tentatives.
            throw $e; // Relance l'exception.
        }
    }

    public function __toString(): string // Méthode magique pour la représentation sous forme de chaîne.
    {
        return $this->member->__toString();
    }

    public function getName(): string // Implémentation de la méthode de l'interface.
    {
        return $this->member->getName();
    }
}
