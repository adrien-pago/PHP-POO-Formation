<?php

namespace App\Club;

use App\Auth\AuthException;
use Throwable;

class CachedMember implements Member
{
    private bool|null $succeeded = null;

    public function __construct(
        private readonly Member $member,
    ) {
    }

    public function auth(string $login, string $password): void
    {
        if (false === $this->succeeded) {
            throw AuthException::invalidCredentials();
        } elseif (true === $this->succeeded) {
            return;
        }

        try {
            $this->member->auth($login, $password);
            $this->succeeded = true;
        } catch (Throwable $e) {
            $this->succeeded = false;
            throw $e;
        }
    }

    public function __toString(): string
    {
        return $this->member->__toString();
    }

    public function getName(): string
    {
        return $this->member->getName();
    }
}
