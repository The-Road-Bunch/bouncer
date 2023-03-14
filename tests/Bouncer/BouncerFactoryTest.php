<?php
declare(strict_types=1);

namespace RoadBunch\Tests\Bouncer;


use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use RoadBunch\Bouncer\AllowList;
use RoadBunch\Bouncer\BouncerFactory;
use RoadBunch\Bouncer\BouncerInterface;
use RoadBunch\Bouncer\Rule;

/**
 * Class BouncerFactoryTest
 *
 * @author Dan McAdams <dan.mcadams@gmail.com>
 */
#[CoversClass(BouncerFactory::class)]
final class BouncerFactoryTest extends TestCase
{
    #[Test]
    #[DataProvider('subjectsProvider')]
    public function createAllowBouncerFromRule(array|string $subjects): void
    {
        $bouncer = BouncerFactory::create(Rule::ALLOW, $subjects);
        $this->assertInstanceOf(BouncerInterface::class, $bouncer);
        $this->assertInstanceOf(AllowList::class, $bouncer);
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

    #[Test]
    public function createAllowBouncer(): void
    {
        $subject = 'subject';
        $bouncer = BouncerFactory::createAllow([$subject]);

        $this->assertTrue($bouncer->isAllowed($subject));
        $this->assertFalse($bouncer->isAllowed(uniqid()));
    }

    #[Test]
    public function createDenyBouncer(): void
    {
        $subject = 'subject';
        $bouncer = BouncerFactory::createDeny([$subject]);

        $this->assertFalse($bouncer->isAllowed($subject));
        $this->assertTrue($bouncer->isAllowed(uniqid()));
    }

    #[Test]
    public function createAllowBouncerFromString(): void
    {
        $subjects = 'subject_one;subject_two;subject_three';
        $bouncer = BouncerFactory::createAllow($subjects);

        $this->assertTrue($bouncer->isAllowed('subject_one'));
        $this->assertTrue($bouncer->isAllowed('subject_two'));
        $this->assertTrue($bouncer->isAllowed('subject_three'));
        $this->assertFalse($bouncer->isAllowed('subject_four'));
    }

    #[Test]
    public function createDenyBouncerFromString(): void
    {
        $subjects = 'subject_one;subject_two;subject_three';
        $bouncer = BouncerFactory::createDeny($subjects);

        $this->assertFalse($bouncer->isAllowed('subject_one'));
        $this->assertFalse($bouncer->isAllowed('subject_two'));
        $this->assertFalse($bouncer->isAllowed('subject_three'));
        $this->assertTrue($bouncer->isAllowed('subject_four'));
    }

    #[Test]
    public function testCreateFromListTrimsSpaces(): void
    {
        $subjects = 'subject_one ; subject_two; subject_three ; ';
        $this->markTestSkipped('');
    }
}
