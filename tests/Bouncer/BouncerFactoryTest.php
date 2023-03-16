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


use JetBrains\PhpStorm\Deprecated;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use RoadBunch\Bouncer\AllowBouncer;
use RoadBunch\Bouncer\Bouncer;
use RoadBunch\Bouncer\BouncerFactory;
use RoadBunch\Bouncer\BouncerInterface;
use RoadBunch\Bouncer\DenyBouncer;
use RoadBunch\Bouncer\Rule;

/**
 * Class BouncerFactoryTest
 *
 * @author Dan McAdams <dan.mcadams@gmail.com>
 */
#[Deprecated(
    reason: 'Will be removed in v2.4',
    replacement: "Use Bouncer::allow or Bouncer::deny instead"
)]
#[CoversClass(BouncerFactory::class)]
final class BouncerFactoryTest extends TestCase
{
    #[Test]
    #[DataProvider('subjectsProvider')]
    public function createAllowBouncerFromRule(array|string $subjects): void
    {
        $bouncer = BouncerFactory::create(Rule::ALLOW, $subjects);
        $this->assertInstanceOf(BouncerInterface::class, $bouncer);
        $this->assertInstanceOf(AllowBouncer::class, $bouncer);
    }

    #[Test]
    #[DataProvider('subjectsProvider')]
    public function createDenyBouncerFromRule(array|string $subjects): void
    {
        $bouncer = BouncerFactory::create(Rule::DENY, $subjects);
        $this->assertInstanceOf(BouncerInterface::class, $bouncer);
        $this->assertInstanceOf(DenyBouncer::class, $bouncer);
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
