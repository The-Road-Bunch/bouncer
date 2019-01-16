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

/**
 * Class FilterListTest
 *
 * @author  Dan McAdams
 * @package RoadBunch\Tests\Lists
 */
class FilterListTest extends TestCase
{
    public function testListDoesNotHaveString()
    {
        $filterList = new TestFilterList([]);
        $this->assertFalse($filterList->validate('example.com'));
    }

    public function testListHasDomain()
    {
        $domain     = 'example.com';
        $filterList = new TestFilterList([$domain]);

        $this->assertTrue($filterList->validate($domain));
    }

    /**
     * @dataProvider invalidDomainListProvider
     *
     * @throws \Exception
     */
    public function testDomainPassedAsNonStringThrowsException($value)
    {
        $this->expectException(\Exception::class);
        new TestFilterList([$value]);
    }

    public function invalidDomainListProvider()
    {
        yield [[]];
        yield [5];
        yield [false];
        yield [true];
    }
}

class TestFilterList extends FilterList
{
    /**
     * Return true or false based on the rules of the list
     *
     * @param string $domain
     *
     * @return bool
     */
    public function validate(string $element): bool
    {
        return $this->has($element);
    }
}
