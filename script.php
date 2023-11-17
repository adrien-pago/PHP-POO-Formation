<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Club\Admin;
use App\Club\Regular;
use App\Club\CachedMember;
use App\Drinks\Alcool;
use App\Level;
use App\User;

echo 'Member count is : ' . Regular::count() . PHP_EOL;

$member1 = new Regular(new User('Ad'), 'member1', 'member1', 11);
$member2 = new Regular(new User('Lou'), 'member2', 'member2', 43);
$member3 = new Regular(new User('Pl'), 'member3', 'member3', 61);

echo 'Member count is : ' . Regular::count() . PHP_EOL;

$admin1 = new CachedMember(new Admin(new Regular(new User('Po'), 'admin1', 'admin1', 12), Level::from('superadmin')));
echo 'Admin is ' . $admin1 . PHP_EOL;

unset($member2);

echo 'Member count is : ' . Regular::count() . PHP_EOL;

$member1->drink(new Alcool());

$admin1->auth('plop', 'plop');
$member1->auth('plop', 'plop');
