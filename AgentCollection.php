<?php

declare(strict_types=1);

/**
 * @phpstan-type Agent array{matricule: string, name: string}
 */
final class AgentCollection implements IteratorAggregate
{
    /**
     * @var array<string, Agent>
     */
    private array $agents;

    /**
     * @param list<Agent> $agents
     */
    public function __construct(array $agents, int $plop)
    {
        $this->agents = array_column($agents, null, 'matricule');
    }

    /**
     * @return Agent
     */
    public function getByMatricule(string $matricule): array
    {
        return $this->agents[$matricule] ?? throw new LogicException();
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->agents);
    }
}
