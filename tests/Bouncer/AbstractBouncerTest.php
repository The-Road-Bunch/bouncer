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
use RoadBunch\Bouncer\BouncerInterface;

/**
 * Class AbstractBouncerTest
 *
 * @author Dan McAdams <dan.mcadams@gmail.com>
 */
#[CoversClass(AbstractBouncer::class)]
final class AbstractBouncerTest extends TestCase
{
    #[Test]
    public function createBouncer(): void
    {
        $this->assertInstanceOf(BouncerInterface::class, $this->makeBouncer());
    }

    #[Test]
    public function createBouncerWithArray(): void
    {
        $subject = ' a string with ; in it';
        $abstractBouncer = $this->makeBouncer([$subject]);

        $this->assertTrue($abstractBouncer->has($subject));
    }

    #[Test]
    public function createBouncerWithString(): void
    {
        $subject = ' a string ';
        $abstractBouncer = $this->makeBouncer($subject);

        $this->assertTrue($abstractBouncer->has($subject));
    }

    #[Test]
    public function createWithSemiColonSeparatedString(): void {
        $subjects = 'subject one ; subject_two ; subject_three; ';
        $abstractBouncer = $this->makeBouncer($subjects);

        $this->assertTrue($abstractBouncer->has('subject one '));
        $this->assertTrue($abstractBouncer->has(' subject_two '));
        $this->assertTrue($abstractBouncer->has(' subject_three'));

        // empty value at end of the ';' separated string should be dropped
        $this->assertFalse($abstractBouncer->has(' '));
    }

    #[Test]
    public function hasMethodValueNotFound(): void
    {
        $abstractBouncer = $this->makeBouncer();
        $subject = 'a string';

        $this->assertFalse($abstractBouncer->has($subject));
    }

    #[Test]
    public function addValue(): void
    {
        $abstractBouncer = $this->makeBouncer();
        $subject = 'a string';

        $abstractBouncer->add($subject);
        $this->assertTrue($abstractBouncer->has($subject));
    }

    #[Test]
    public function removeValue(): void
    {
        $subject = 'a string';
        $abstractBouncer = $this->makeBouncer([$subject]);

        $abstractBouncer->remove($subject);
        $this->assertFalse($abstractBouncer->has($subject));
    }

    private function makeBouncer(array|string $values = []): AbstractBouncer
    {
        return $this->getMockForAbstractClass(AbstractBouncer::class, arguments: [$values]);
    }
}
