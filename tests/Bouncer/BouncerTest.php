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


use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use RoadBunch\Bouncer\AllowBouncer;
use RoadBunch\Bouncer\Bouncer;
use RoadBunch\Bouncer\BouncerInterface;
use RoadBunch\Bouncer\DenyBouncer;

/**
 * Class BouncerTest
 *
 * @author Dan McAdams <dan.mcadams@gmail.com>
 */
#[CoversClass(Bouncer::class)]
final class BouncerTest extends TestCase
{
    #[Test]
    #[DataProvider('subjectsProvider')]
    public function createAllowBouncer(array|string $subjects): void
    {
        $bouncer = Bouncer::allow($subjects);
        $this->assertInstanceOf(BouncerInterface::class, $bouncer);
        $this->assertInstanceOf(AllowBouncer::class, $bouncer);

        if (is_string($subjects)) {
            $subjects = explode(';', $subjects);
        }
        foreach ($subjects as $subject) {
            $this->assertTrue($bouncer->isAllowed($subject));
        }
        $this->assertFalse($bouncer->isAllowed(uniqid())); // random string
    }

    #[Test]
    #[DataProvider('subjectsProvider')]
    public function createDenyBouncer(array|string $subjects): void
    {
        $bouncer = Bouncer::deny($subjects);
        $this->assertInstanceOf(BouncerInterface::class, $bouncer);
        $this->assertInstanceOf(DenyBouncer::class, $bouncer);

        if (is_string($subjects)) {
            $subjects = explode(';', $subjects);
        }
        foreach ($subjects as $subject) {
            $this->assertFalse($bouncer->isAllowed($subject));
        }
        $this->assertTrue($bouncer->isAllowed(uniqid())); // random string
    }

    public static function subjectsProvider(): array
    {
        return [
            'array' => [
                ['subject_one', 'subject_two', 'subject_three'],
            ],
            'single string' => [
                'subject_one',
            ],
            '; separated list' => [
                'subject_one;subject_two;subject_three',
            ],
            '; separated list with spaces' => [
                'subject_one ; subject_two ; subject_three',
            ],
        ];
    }
}
