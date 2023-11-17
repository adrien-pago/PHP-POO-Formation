<?php

namespace App;

class Unique
{
    private static self|null $self = null;

    private function __construct()
    {

    }

    public static function get(): self
    {
        if (self::$self === null) {
            self::$self = new self();
        }

        return self::$self;
    }
}
