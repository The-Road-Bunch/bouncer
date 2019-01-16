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
use RoadBunch\Lists\FilterList;
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

        $this->assertInstanceOf(FilterList::class, $whitelist);

        $this->assertTrue($whitelist->validate($domain));
        $this->assertFalse($whitelist->validate('example.com'));
    }
}

