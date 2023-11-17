<?php

namespace App\Club;

use App\Auth\AuthException;
use App\Drinks\Beverage;
use App\User;
use SplObjectStorage;
use WeakReference;
use function count;
use const PHP_EOL;

class Regular implements Member
{
    private static SplObjectStorage|null $members = null;

    private WeakReference $self;

    public function __construct(
        private readonly User $user,
        public readonly string $login,
        public readonly string $password,
        public readonly int    $age,
    ) {
        $this->self = WeakReference::create($this);
        self::addMember($this->self);
    }

    private static function addMember(WeakReference $member): void
    {
        if (null === self::$members) {
            self::$members = new SplObjectStorage();
        }

        self::$members->attach($member);
    }

    public function __destruct()
    {
        self::$members->detach($this->self);
    }

    public function auth(
        string $login,
        string $password,
    ): void {
        if ($this->login === $login && $this->password === $password) {
            return;
        }

        throw AuthException::invalidCredentials();
    }

    public static function count(): int
    {
        if (self::$members === null) {
            return 0;
        }

        return count(self::$members);
    }

    public function __toString(): string
    {
        return "'{$this->getName()}'#{$this->login}";
    }

    public function getName(): string
    {
        return $this->user->name;
    }

    public function drink(Beverage $beverage): void
    {
        echo 'I just drank ' . $beverage->getQuantityInCl() / 100 . 'L of ' . $beverage::class . PHP_EOL;
    }
}
