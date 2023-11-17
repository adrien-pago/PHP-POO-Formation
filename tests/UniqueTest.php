<?php

declare(strict_types=1);

use App\Unique;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Unique::class)]
class UniqueTest extends TestCase
{
    public function testItCannotBeInstanciated(): void
    {
        $this->expectException(Error::class);
        new Unique();
    }

    public function testEnsureItIsASingleton(): void
    {
        $this->assertSame(Unique::get(), Unique::get());
    }
}
