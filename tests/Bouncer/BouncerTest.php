<?php
declare(strict_types=1);

namespace RoadBunch\Tests\Bouncer;


use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use RoadBunch\Bouncer\Bouncer;
use RoadBunch\Bouncer\BouncerFactory;

#[CoversClass(BouncerFactory::class)]
class BouncerTest extends TestCase
{
    public function testCreateWithAllowList(): void
    {
        $subject = 'subject';
        $bouncer = BouncerFactory::create(Bouncer::ALLOW, [$subject]);

        $this->assertTrue($bouncer->isAllowed($subject));
    }

    public function testCreateWithDenyList(): void
    {
        $subject = 'subject';
        $bouncer = BouncerFactory::create(Bouncer::DENY, [$subject]);

        $this->assertFalse($bouncer->isAllowed($subject));
    }
}
