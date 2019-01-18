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

/**
 * Class FilterListTest
 *
 * @author  Dan McAdams
 * @package RoadBunch\Tests\Lists
 */
class NamedStringCollectionTest extends TestCase
{
    const WHITELIST = 'whitelist';

    public function testGetListType()
    {
        $filterList = new NamedStringCollection(self::WHITELIST, []);
        $this->assertEquals(self::WHITELIST, $filterList->name());
    }
}
