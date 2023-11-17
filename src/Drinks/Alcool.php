<?php

namespace App\Drinks;

class Alcool implements Beverage
{
    public function getQuantityInCl(): int
    {
        return 100;
    }
}
