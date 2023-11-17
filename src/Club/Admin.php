<?php

namespace App\Club;

use App\Level;

class Admin implements Member
{
    public function __construct(
        private readonly Member $member,
        private readonly Level $level = Level::Admin,
    ) {
    }

    public function auth(
        string $login,
        string $password,
    ): void {
        if ($this->level === Level::SuperAdmin) {
            return;
        }

        $this->member->auth($login, $password);
    }

    public function __toString(): string
    {
        return (string) $this->member . " as {$this->level->label()}";
    }

    public function getName(): string
    {
        return $this->member->getName();
    }
}
