<?php

require_once __DIR__ . '/vendor/autoload.php'; // Charge automatiquement les classes nécessaires.

use App\Club\Admin; // Utilisation des espaces de noms pour organiser les classes.
use App\Club\Regular;
use App\Club\CachedMember;
use App\Level;
use App\User;

echo 'Member count is : ' . Regular::count() . PHP_EOL; // Appelle une méthode statique.

$member1 = new Regular(new User('Ad'), 'member1', 'member1', 11); // Création d'instances de classes.
$member2 = new Regular(new User('Lou'), 'member2', 'member2', 43);
$member3 = new Regular(new User('Pl'), 'member3', 'member3', 61);

echo 'Member count is : ' . Regular::count() . PHP_EOL;

// Utilisation de l'enrobage et de la composition pour étendre les fonctionnalités.
$admin1 = new CachedMember(new Admin(new Regular(new User('Po'), 'admin1', 'admin1', 12), Level::from('superadmin')));
echo 'Admin is ' . $admin1 . PHP_EOL;

unset($member2); // Déréférencement d'une instance.

echo 'Member count is : ' . Regular::count() . PHP_EOL;

$admin1->auth('plop', 'plop'); // Appel de méthodes sur les objets.
$member1->auth('plop', 'plop');
