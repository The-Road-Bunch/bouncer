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
use RoadBunch\Lists\Blacklist;
use RoadBunch\Lists\NamedStringCollection;

/**
 * Class BlacklistTest
 *
 * @author  Dan McAdams
 * @package RoadBunch\Tests\Lists
 */
class BlacklistTest extends TestCase
{
    public function testCreateBlacklist()
    {
        $domain    = 'blacklisted.com';
        $blacklist = new Blacklist([$domain]);

        $this->assertInstanceOf(NamedStringCollection::class, $blacklist);
        $this->assertEquals(NamedStringCollection::TYPE_BLACKLIST, $blacklist->name());
    }
}
