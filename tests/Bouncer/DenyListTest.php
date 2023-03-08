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


use RoadBunch\Bouncer\DenyList;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Class DenyListTest
 *
 * @author Dan McAdams <dan.mcadams@gmail.com>
 */
#[CoversClass(DenyList::class)]
final class DenyListTest extends TestCase
{
    #[Test]
    public function createDenyList()
    {
        $domain = 'denied';
        $blockList = new DenyList([$domain]);

        $this->assertFalse($blockList->isAllowed($domain));
    }

    #[Test]
    public function allowRemovesStringFromDenyList(): void
    {
        $domain = 'denied';
        $blockList = new DenyList([$domain]);

        $this->assertFalse($blockList->isAllowed($domain));

        $blockList->allow($domain);
        $this->assertTrue($blockList->isAllowed($domain));
    }

    #[Test]
    public function denyAddsStringToDenyList(): void
    {
        $domain = 'denied';
        $blockList = new DenyList();

        $this->assertTrue($blockList->isAllowed($domain));

        $blockList->deny($domain);
        $this->assertFalse($blockList->isAllowed($domain));
    }

    #[Test]
    public function withDuplicateString(): void
    {
        $allowList = new DenyList(['d', 'd']);
        $this->assertFalse($allowList->isAllowed('d'));

        $allowList->allow('d');
        $this->assertTrue($allowList->isAllowed('d'));
    }
}
