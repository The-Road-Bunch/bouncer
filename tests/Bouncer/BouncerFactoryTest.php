<?php
declare(strict_types=1);

namespace RoadBunch\Tests\Bouncer;


use RoadBunch\Bouncer\Rule;
use RoadBunch\Bouncer\BouncerFactory;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;

/**
 * Class BouncerFactoryTest
 *
 * @author Dan McAdams <dan.mcadams@gmail.com>
 */
#[CoversClass(BouncerFactory::class)]
final class BouncerFactoryTest extends TestCase
{
    #[Test]
    public function createWithAllowList(): void
    {
        $subject = 'subject';
        $bouncer = BouncerFactory::create(Rule::ALLOW, [$subject]);

        $this->assertTrue($bouncer->isAllowed($subject));
    }

    #[Test]
    public function createWithDenyList(): void
    {
        $subject = 'subject';
        $bouncer = BouncerFactory::create(Rule::DENY, [$subject]);

        $this->assertFalse($bouncer->isAllowed($subject));
    }
}
