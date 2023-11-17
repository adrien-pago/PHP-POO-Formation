<?php

namespace App\Club;

use App\Level;

class Admin implements Member // Implémentation de l'interface Member.
{
    public function __construct(
        private readonly Member $member, // Composition: Admin "a un" Member.
        private readonly Level $level = Level::Admin, // Valeur par défaut pour le niveau.
    ) {
    }

    public function auth(
        string $login,
        string $password,
    ): void {
        if ($this->level === Level::SuperAdmin) {
            return; // Traitement spécifique pour les superadmins.
        }

        $this->member->auth($login, $password); // Délègue l'authentification au membre interne.
    }

    public function __toString(): string // Méthode magique pour la représentation sous forme de chaîne.
    {
        return (string) $this->member . " as {$this->level->label()}";
    }

    public function getName(): string // Implémentation de la méthode de l'interface.
    {
        return $this->member->getName();
    }
}
