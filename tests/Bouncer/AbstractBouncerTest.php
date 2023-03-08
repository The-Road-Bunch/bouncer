<?php
declare(strict_types=1);
/**
 * This file is part of the theroadbunch/bouncer package.
 *
 * (c) Dan McAdams <danmcadams@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RoadBunch\Tests\Bouncer;


use RoadBunch\Bouncer\AbstractBouncer;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Class AbstractBouncerTest
 *
 * @author Dan McAdams <dan.mcadams@gmail.com>
 */
#[CoversClass(AbstractBouncer::class)]
final class AbstractBouncerTest extends TestCase
{
    #[Test]
    public function hasMethodValueFound(): void
    {
        $subject = 'a string';
        $abstractBouncer = $this->createMockBouncer([$subject]);

        $this->assertTrue($abstractBouncer->has($subject));
    }

    #[Test]
    public function hasMethodValueNotFound(): void
    {
        $abstractBouncer = $this->createMockBouncer();
        $subject = 'a string';

        $this->assertFalse($abstractBouncer->has($subject));
    }

    #[Test]
    public function addValue(): void
    {
        $abstractBouncer = $this->createMockBouncer();
        $subject = 'a string';

        $abstractBouncer->add($subject);
        $this->assertTrue($abstractBouncer->has($subject));
    }

    #[Test]
    public function removeValue(): void
    {
        $subject = 'a string';
        $abstractBouncer = $this->createMockBouncer([$subject]);

        $abstractBouncer->remove($subject);
        $this->assertFalse($abstractBouncer->has($subject));
    }

    private function createMockBouncer(array $values = []): AbstractBouncer
    {
        return $this->getMockForAbstractClass(AbstractBouncer::class, arguments: [$values]);
    }
}
