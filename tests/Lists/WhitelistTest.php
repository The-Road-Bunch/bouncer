<?php
/**
 * This file is part of the theroadbunch/filter-lists package.
 *
 * (c) Dan McAdams <danmcadams@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RoadBunch\Tests\Lists;


use PHPUnit\Framework\TestCase;
use RoadBunch\Lists\NamedStringCollection;
use RoadBunch\Lists\Whitelist;

/**
 * Class WhitelistTest
 *
 * @author  Dan McAdams
 * @package RoadBunch\Tests\Lists
 */
class WhitelistTest extends TestCase
{
    public function testCreateWhitelist()
    {
        $domain    = 'whitelisted.com';
        $whitelist = new Whitelist([$domain]);

        $this->assertInstanceOf(NamedStringCollection::class, $whitelist);
        $this->assertEquals(NamedStringCollection::TYPE_WHITELIST, $whitelist->name());
    }
}
