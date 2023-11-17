<?php

declare(strict_types=1);

namespace Club;

use App\Club\CachedMember;
use App\Club\Member;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use function is_a;

#[CoversClass(CachedMember::class)]
class CachedMemberTest extends TestCase
{
    public function testItIsAMember(): void
    {
        $this->assertTrue(is_a(CachedMember::class, Member::class, true));
    }

    public function testItCallsInnerAuthMethodOnlyOnce(): void
    {
        $member = $this->createMock(Member::class);

        $member->expects($this->once())
            ->method('auth')
            ->with($this->identicalTo('login'), $this->identicalTo('password'));

        $cachedMember = new CachedMember($member);

        $cachedMember->auth('login', 'password');
        $cachedMember->auth('login', 'password');
        $cachedMember->auth('login', 'password');
    }
}
