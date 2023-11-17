<?php

declare(strict_types=1);

use App\Level;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(Level::class)]
class LevelTest extends TestCase
{
    public function testIsStringBackedEnum(): void
    {
        $this->assertTrue(is_a(Level::class, BackedEnum::class, true));

        $r = new ReflectionEnum(Level::class);
        $this->assertSame('string', $r->getBackingType()->getName());
    }

    public function testAllCasesHaveALabel(): void
    {
        foreach (Level::cases() as $level) {
            $level->label();
            $this->addToAssertionCount(1);
        }
    }

    public static function getAllCasesWithTheirLabel(): Generator
    {
        yield 'admin' => ['admin', 'Admin'];
        yield 'superadmin' => ['superadmin', 'Super Admin 3000 ++'];
    }

    /**
     * @param key-of<Level> $level
     */
    #[DataProvider('getAllCasesWithTheirLabel')]
    public function testItHasCorrectLabel(string $level, string $label): void
    {
        $this->assertSame(Level::from($level)->label(), $label);
    }
}
