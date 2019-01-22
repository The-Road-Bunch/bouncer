<?php
/**
 * This file is part of the theroadbunch/bouncer package.
 *
 * (c) Dan McAdams <danmcadams@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RoadBunch\Tests\String;


use PHPUnit\Framework\TestCase;
use RoadBunch\String\NamedStringCollection;

/**
 * Class NamedStringCollectionTest
 *
 * @author  Dan McAdams
 * @package RoadBunch\Tests\String
 */
class NamedStringCollectionTest extends TestCase
{
    public function testGetListType()
    {
        $name = 'blacklist';
        $filterList = new NamedStringCollection($name, []);
        $this->assertEquals($name, $filterList->name());
    }
}
