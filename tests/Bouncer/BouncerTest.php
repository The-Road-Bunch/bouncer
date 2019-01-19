<?php
/**
 * This file is part of the theroadbunch/filter-lists package.
 *
 * (c) Dan McAdams <danmcadams@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RoadBunch\Tests\Bouncer;


use PHPUnit\Framework\TestCase;
use RoadBunch\Bouncer\Blacklist;
use RoadBunch\Bouncer\NamedStringCollection;
use RoadBunch\Bouncer\InvalidListTypeException;
use RoadBunch\Bouncer\Bouncer;
use RoadBunch\Bouncer\Whitelist;

/**
 * Class BouncerTest
 *
 * @author  Dan McAdams
 * @package RoadBunch\Tests\Lists
 */
class BouncerTest extends TestCase
{
    const TEST_STRING = 'test@example.com';

    public function testBouncerWithWhitelist()
    {
        $whitelist = new Whitelist();
        $bouncer   = new Bouncer($whitelist);

        // empty whitelist
        $this->assertTrue($bouncer->isBlacklisted(self::TEST_STRING));
        $this->assertFalse($bouncer->isAllowed(self::TEST_STRING));

        // populated whitelist
        $whitelist->add(self::TEST_STRING);
        $this->assertFalse($bouncer->isBlacklisted(self::TEST_STRING));
        $this->assertTrue($bouncer->isAllowed(self::TEST_STRING));
    }

    public function testBouncerWithBlacklist()
    {
        $whitelist = new Blacklist();
        $bouncer   = new Bouncer($whitelist);

        // empty blacklist
        $this->assertFalse($bouncer->isBlacklisted(self::TEST_STRING));
        $this->assertTrue($bouncer->isAllowed(self::TEST_STRING));

        // populated blacklist
        $whitelist->add(self::TEST_STRING);
        $this->assertTrue($bouncer->isBlacklisted(self::TEST_STRING));
        $this->assertFalse($bouncer->isAllowed(self::TEST_STRING));
    }

    public function testCreateWithNonBlackOrWhiteList()
    {
        $this->expectException(InvalidListTypeException::class);

        $filterList = new NamedStringCollection('not-a-black-or-white-list', []);
        new Bouncer($filterList);
    }
}
