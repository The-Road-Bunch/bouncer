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
use RoadBunch\Bouncer\Blacklist;
use RoadBunch\Bouncer\InvalidListTypeException;
use RoadBunch\Bouncer\Bouncer;
use RoadBunch\Bouncer\Whitelist;
use RoadBunch\String\NamedStringCollection;

/**
 * Class BouncerTest
 *
 * @author  Dan McAdams
 * @package RoadBunch\Tests\Bouncer
 */
class BouncerTest extends TestCase
{
    public function testWithEmptyWhitelistDisallowsAllStrings()
    {
        $bouncer = new Bouncer(new Whitelist());

        $this->assertFalse($bouncer->isAllowed('not-in-whitelist'));
        $this->assertTrue($bouncer->isBlacklisted('also-not-in-whitelist'));
    }

    public function testWithWhitelistAllowsOnlyWhitelistedStrings()
    {
        $whitelisted = 'whitelisted';
        $bouncer     = new Bouncer(new Whitelist([$whitelisted]));

        $this->assertTrue($bouncer->isAllowed($whitelisted));
        $this->assertFalse($bouncer->isBlacklisted($whitelisted));
    }

    public function testWithEmptyBlacklistAllowsAllStrings()
    {
        $bouncer = new Bouncer(new Blacklist());

        $this->assertFalse($bouncer->isBlacklisted('not-in-blacklist'));
        $this->assertTrue($bouncer->isAllowed('also-not-in-blacklist'));
    }

    public function testWithBlacklistDisallowsBlacklistedStrings()
    {
        $blacklisted = 'blacklisted';
        $bouncer     = new Bouncer(new Blacklist([$blacklisted]));

        $this->assertTrue($bouncer->isBlacklisted($blacklisted));
        $this->assertFalse($bouncer->isAllowed($blacklisted));
    }

    public function testAllowAndDisallowPreviouslyBlacklistedString()
    {
        $blacklisted = 'blacklisted';
        $blacklist   = new Blacklist([$blacklisted]);
        $bouncer     = new Bouncer($blacklist);

        $bouncer->addToWhitelist($blacklisted);
        $this->assertFalse($bouncer->isBlacklisted($blacklisted));

        $bouncer->addToBlacklist($blacklisted);
        $this->assertTrue($bouncer->isBlacklisted($blacklisted));
    }

    public function testDisallowAndAllowPreviouslyWhitelistedString()
    {
        $whitelisted = 'whitelisted';
        $whitelist   = new Whitelist([$whitelisted]);
        $bouncer     = new Bouncer($whitelist);

        $bouncer->addToBlacklist($whitelisted);
        $this->assertFalse($bouncer->isAllowed($whitelisted));

        $bouncer->addToWhitelist($whitelisted);
        $this->assertTrue($bouncer->isAllowed($whitelisted));
    }

    public function testCreateWithEmptyListDefaultsToEmptyBlacklist()
    {
        $str     = 'test string';
        $bouncer = new Bouncer();

        $this->assertFalse($bouncer->isBlacklisted($str));

        $bouncer->addToBlacklist($str);
        $this->assertTrue($bouncer->isBlacklisted($str));
    }

    public function testCreateWithNonBlackOrWhiteList()
    {
        $this->expectException(InvalidListTypeException::class);

        $filterList = new NamedStringCollection('not-a-black-or-white-list', []);
        new Bouncer($filterList);
    }
}
