<?php

declare(strict_types=1);

class Factory
{
    private const MAPPING = [
        'italic' => 'DecoratorItalic',
        'bold' => 'Bold',
    ];

    public static function build(...$decorators)
    {
        $pen = new Pen();

        foreach ($decorators as $decorator) {
            $class = self::MAPPING[$decorator];
            $pen = new $class($pen);
        }

        return $pen;
    }
}

$obj = Factory::build('italic', 'bold');
