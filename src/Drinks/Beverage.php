<?php

declare(strict_types=1);

namespace App\Drinks;

interface Beverage
{
    public function getQuantityInCl(): int;
}
