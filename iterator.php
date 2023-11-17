<?php

class StepIterator implements IteratorAggregate // Implémentation de l'interface IteratorAggregate.
{
    public function __construct(
        private readonly iterable $inner, // Propriétés typées et privées.
        private readonly int $step = 1
    ) {
    }

    public function getIterator(): Traversable // Implémentation de la méthode requise par l'interface.
    {
        $index = 0;
        foreach ($this->inner as $key => $item) {
            if (($index % $this->step) === 0) {
                yield $key => $item; // Utilisation de 'yield' pour créer un générateur.
            }
            $index++;
        }
    }
}

// Utilisation de fonctions anonymes pour créer des générateurs.
$generatorSimple = static function (): Generator {
    yield 'plop' => 'plop';
    yield 'plop' => 'plap';
    yield 'plop' => 'plip';
    yield 'plop' => 'plup';
};

$generator = static function (): Generator {
    $today = new DateTimeImmutable('today');

    yield $today => 'plop';

    $day1 = $today->modify('+ 1 day');
    yield $day1 => 'plip';

    $day2 = $day1->modify('+ 1 day');
    yield $day2 => 'plap';

    $day3 = $day2->modify('+ 1 day');
    yield $day3 => 'plup';
};

$array = range(1, 10);
$array = array_reverse($array, true);

$list = $generatorSimple();
$stepIterator = new StepIterator($array, 2);

foreach ($stepIterator as $key => $value) {
    echo "{$key} ==> {$value}" . PHP_EOL; // Parcours avec l'itérateur personnalisé.
}
echo PHP_EOL;
