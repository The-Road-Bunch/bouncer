<?php
/**
 * This file is part of the theroadbunch/bouncer package.
 *
 * (c) Dan McAdams <danmcadams@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RoadBunch\Tests\Bouncer;


use PHPUnit\Framework\TestCase;
use RoadBunch\Bouncer\Bouncer;
use RoadBunch\Bouncer\NamedStringCollection;
use RoadBunch\Bouncer\Whitelist;

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
        $this->assertEquals(Bouncer::WHITELIST, $whitelist->name());
    }
}
