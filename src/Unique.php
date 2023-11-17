<?php

namespace App;

class Unique
{
    private static self|null $self = null; // Propriété statique pour stocker l'instance singleton.

    private function __construct() // Constructeur privé pour empêcher la création d'instances externes.
    {
    }

    public static function get(): self // Méthode statique pour accéder à l'instance.
    {
        if (self::$self === null) { // Crée l'instance uniquement si elle n'existe pas déjà.
            self::$self = new self();
        }

        return self::$self; // Retourne l'instance existante.
    }
}

Unique::get(); // Appel de la méthode pour obtenir l'instance.
