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
use RoadBunch\Lists\InvalidListTypeException;
use RoadBunch\Lists\BlacklistValidator;
use RoadBunch\Lists\Whitelist;

class BlacklistValidatorTest extends TestCase
{
    public function testCreateListValidatorWithBlacklist()
    {
        $str = 'test@example.com';

        // empty blacklist
        $blacklist = new Blacklist();
        $validator = new BlacklistValidator($blacklist);

        $this->assertFalse($validator->isBlacklisted($str));

        // populate blacklist
        $blacklist->add($str);
        $this->assertTrue($validator->isBlacklisted($str));
    }

    public function testCreateListValidatorWithWhitelist()
    {
        $str = 'test@example.com';

        // empty whitelist
        $whitelist = new Whitelist();
        $validator = new BlacklistValidator($whitelist);

        $this->assertTrue($validator->isBlacklisted($str));

        // populate whitelist
        $whitelist->add($str);
        $this->assertFalse($validator->isBlacklisted($str));
    }

    public function testCreateWithNonBlackOrWhiteList()
    {
        $this->expectException(InvalidListTypeException::class);

        $filterList = new NamedStringCollection('not-a-black-or-white-list', []);
        new BlacklistValidator($filterList);
    }
}
