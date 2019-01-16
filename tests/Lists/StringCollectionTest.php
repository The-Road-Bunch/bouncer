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


use mysql_xdevapi\Collection;
use PHPUnit\Framework\TestCase;
use RoadBunch\Lists\NonStringException;
use RoadBunch\Lists\StringCollection;

class StringCollectionTest extends TestCase
{
    const EXAMPLE_STR = 'dan@example.com';

    /** @var StringCollection $collection */
    protected $collection;

    public function setUp()
    {
        $this->collection = new StringCollection([self::EXAMPLE_STR]);
    }

    public function testHasElement()
    {
        $this->assertTrue($this->collection->has(self::EXAMPLE_STR));
        $this->assertFalse($this->collection->has('I just made this string up'));
    }

    public function testAddElement()
    {
        $str = 'new element';
        $this->collection->add($str);

        $this->assertTrue($this->collection->has($str));
    }

    public function testIgnoreDuplicates()
    {
        $collection = new StringCollectionSpy();

        $str = 'new element';
        $collection->add($str);
        $collection->add($str);

        $this->assertCount(1, $collection->getElements());
    }

    public function testRemoveElement()
    {
        $this->collection->add(self::EXAMPLE_STR);
        $this->collection->remove(self::EXAMPLE_STR);

        $this->assertFalse($this->collection->has(self::EXAMPLE_STR));
    }

    public function testRemoveNonExistingElementHasNoEffect()
    {
        $this->collection->add(self::EXAMPLE_STR);

        $this->collection->remove('string not in collection');
        $this->assertTrue($this->collection->has(self::EXAMPLE_STR));
    }

    public function testNonString()
    {
        $this->expectException(NonStringException::class);
        $collection = new StringCollection([null, []]);
    }
}

class StringCollectionSpy extends StringCollection
{
    public function getElements()
    {
        return $this->elements;
    }
}
