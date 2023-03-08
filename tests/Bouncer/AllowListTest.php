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


use RoadBunch\Bouncer\AllowList;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Class AllowListTest
 *
 * @author Dan McAdams <dan.mcadams@gmail.com>
 */
#[CoversClass(AllowList::class)]
final class AllowListTest extends TestCase
{
    #[Test]
    public function createAllowList()
    {
        $domain = 'allowed';
        $allowList = new AllowList([$domain]);

        $this->assertTrue($allowList->isAllowed($domain));
    }

    #[Test]
    #[TestDox('This does something')]
    public function denyRemovesStringFromBlockList(): void
    {
        $domain = 'allowed';
        $allowList = new AllowList([$domain]);

        $this->assertTrue($allowList->isAllowed($domain));

        $allowList->deny($domain);
        $this->assertFalse($allowList->isAllowed($domain));
    }

    #[Test]
    public function allowAddsStringToBlockList(): void
    {
        $domain = 'allowed';
        $allowList = new AllowList();

        $this->assertFalse($allowList->isAllowed($domain));

        $allowList->allow($domain);
        $this->assertTrue($allowList->isAllowed($domain));
    }

    #[Test]
    public function withDuplicateString(): void
    {
        $allowList = new AllowList(['d', 'd']);
        $this->assertTrue($allowList->isAllowed('d'));

        $allowList->deny('d');
        $this->assertFalse($allowList->isAllowed('d'));
    }
}
