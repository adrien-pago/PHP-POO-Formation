<?php

namespace Tests\Club;

use App\Auth\AuthException;
use App\Club\Admin;
use App\Club\Regular;
use App\Level;
use App\User;
use Generator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Admin::class)]
#[UsesClass(Regular::class)]
#[UsesClass(User::class)]
#[UsesClass(AuthException::class)]
class AdminTest extends TestCase
{
    private Regular $member;

    public function setUp(): void
    {
        $this->member = new Regular(new User('Po'), 'admin1', 'admin1', 12);
    }

    public static function provideValidDataForSuperAdmin(): Generator
    {
        yield 'both are invalid' => ['plop', 'plop'];
        yield 'invalid password' => ['admin1', 'plop'];
        yield 'both are valid' => ['admin1', 'admin1'];
        yield 'invalid login' => ['plop', 'admin1'];
    }

    #[DataProvider('provideValidDataForSuperAdmin')]
    public function testIfSuperAdminNoNeedToCheckCredentials(string $login, string $password): void
    {
        $admin = new Admin($this->member, Level::SuperAdmin);

        $admin->auth($login, $password);
        $this->addToAssertionCount(1);
    }

    public static function provideInvalidDataForNonSuperAdmin(): Generator
    {
        foreach (Level::cases() as $level) {
            if ($level === Level::SuperAdmin) {
                continue;
            }

            yield "both are invalid ($level->name)" => [$level, 'plop', 'plop'];
            yield "invalid password ($level->name)" => [$level, 'admin1', 'plop'];
            yield "invalid login ($level->name)" => [$level, 'plop', 'admin1'];
        }
    }

    #[DataProvider('provideInvalidDataForNonSuperAdmin')]
    public function testIfNotSuperAdminThenInvalidCredentialsMustBeError(Level $level, string $login, string $password): void
    {
        $admin = new Admin($this->member, $level);

        $this->expectException(AuthException::class);
        $admin->auth($login, $password);
    }
}
