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
use PHPUnit\Framework\TestCase;
use RoadBunch\Bouncer\AllowList;

/**
 * Class AllowListTest
 *
 * @author Dan McAdams <dan.mcadams@gmail.com>
 */
#[CoversClass(AllowList::class)]
final class AllowListTest extends TestCase
{
    public function testCreateBlacklist()
    {
        $domain = 'blacklisted.com';
        $allowList = new AllowList([$domain]);

        $this->assertTrue($allowList->isAllowed($domain));
    }

    public function testDenyRemovesStringFromBlockList(): void
    {
        $domain = 'blacklisted.com';
        $allowList = new AllowList([$domain]);

        $this->assertTrue($allowList->isAllowed($domain));

        $allowList->deny($domain);
        $this->assertFalse($allowList->isAllowed($domain));
    }

    public function testAllowAddsStringToBlockList(): void
    {
        $domain = 'blacklisted.com';
        $allowList = new AllowList();

        $this->assertFalse($allowList->isAllowed($domain));

        $allowList->allow($domain);
        $this->assertTrue($allowList->isAllowed($domain));
    }

    public function testAddDuplicateString(): void
    {
        $allowList = new AllowList(['d', 'd']);
        $this->assertTrue($allowList->isAllowed('d'));

        $allowList->deny('d');
        $this->assertFalse($allowList->isAllowed('d'));
    }
}
