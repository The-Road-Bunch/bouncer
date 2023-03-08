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
use RoadBunch\Bouncer\BlockList;

/**
 * Class BlockListTest
 *
 * @author Dan McAdams <dan.mcadams@gmail.com>
 */
#[CoversClass(BlockList::class)]
final class BlockListTest extends TestCase
{
    public function testCreateBlacklist()
    {
        $domain = 'blacklisted.com';
        $blockList = new BlockList([$domain]);

        $this->assertFalse($blockList->isAllowed($domain));
    }

    public function testAllowRemovesStringFromBlockList(): void
    {
        $domain = 'blacklisted.com';
        $blockList = new BlockList([$domain]);

        $this->assertFalse($blockList->isAllowed($domain));

        $blockList->allow($domain);
        $this->assertTrue($blockList->isAllowed($domain));
    }

    public function testDenyAddsStringToBlockList(): void
    {
        $domain = 'blacklisted.com';
        $blockList = new BlockList();

        $this->assertTrue($blockList->isAllowed($domain));

        $blockList->deny($domain);
        $this->assertFalse($blockList->isAllowed($domain));
    }
}
