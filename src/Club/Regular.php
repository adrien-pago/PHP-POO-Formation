<?php

namespace App\Club;

use App\Auth\AuthException;
use App\User;
use SplObjectStorage;
use WeakReference;
use function count;

class Regular implements Member // Implémentation de l'interface Member.
{
    private static SplObjectStorage|null $members = null; // Stockage statique des membres.

    private WeakReference $self; // Référence faible à l'instance courante.

    public function __construct(
        private readonly User $user, // Composition: Regular "a un" User.
        public readonly string $login,
        public readonly string $password,
        public readonly int    $age,
    ) {
        $this->self = WeakReference::create($this); // Crée une référence faible.
        self::addMember($this->self); // Ajoute le membre au stockage.
    }

    private static function addMember(WeakReference $member): void // Ajoute un membre.
    {
        if (null === self::$members) {
            self::$members = new SplObjectStorage(); // Initialise le stockage si nécessaire.
        }

        self::$members->attach($member); // Attache le membre au stockage.
    }

    public function __destruct() // Méthode appelée à la destruction de l'objet.
    {
        self::$members->detach($this->self); // Détache le membre du stockage.
    }

    public function auth(
        string $login,
        string $password,
    ): void {
        if ($this->login === $login && $this->password === $password) {
            return; // Authentification réussie.
        }

        throw AuthException::invalidCredentials(); // Lance une exception si échec.
    }

    public static function count(): int // Compte le nombre de membres.
    {
        if (self::$members === null) {
            return 0; // Retourne 0 si aucun membre.
        }

        return count(self::$members); // Retourne le nombre de membres.
    }

    public function __toString(): string // Représentation sous forme de chaîne.
    {
        return "'{$this->getName()}'#{$this->login}";
    }

    public function getName(): string // Obtient le nom de l'utilisateur.
    {
        return $this->user->name;
    }
}
