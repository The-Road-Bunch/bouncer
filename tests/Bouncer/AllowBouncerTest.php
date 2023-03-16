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


use RoadBunch\Bouncer\AllowBouncer;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Class AllowBouncerTest
 *
 * @author Dan McAdams <dan.mcadams@gmail.com>
 */
#[CoversClass(AllowBouncer::class)]
final class AllowBouncerTest extends TestCase
{
    #[Test]
    public function createAllowList()
    {
        $domain = 'allowed';
        $bouncer = new AllowBouncer([$domain]);

        $this->assertTrue($bouncer->isAllowed($domain));
    }

    #[Test]
    #[TestDox('This does something')]
    public function denyRemovesStringFromBlockList(): void
    {
        $domain = 'allowed';
        $bouncer = new AllowBouncer([$domain]);

        $this->assertTrue($bouncer->isAllowed($domain));

        $bouncer->deny($domain);
        $this->assertFalse($bouncer->isAllowed($domain));
    }

    #[Test]
    public function allowAddsStringToBlockList(): void
    {
        $domain = 'allowed';
        $bouncer = new AllowBouncer();

        $this->assertFalse($bouncer->isAllowed($domain));

        $bouncer->allow($domain);
        $this->assertTrue($bouncer->isAllowed($domain));
    }

    #[Test]
    public function withDuplicateString(): void
    {
        $bouncer = new AllowBouncer(['d', 'd']);
        $this->assertTrue($bouncer->isAllowed('d'));

        $bouncer->deny('d');
        $this->assertFalse($bouncer->isAllowed('d'));
    }
}
