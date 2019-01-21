<?php
/**
 * This file is part of the theroadbunch/bouncer package.
 *
 * (c) Dan McAdams <danmcadams@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RoadBunch\Bouncer;


class StringCollection implements StringCollectionInterface
{
    protected $elements = [];

    /**
     * StringCollection constructor.
     *
     * @param string[] $elements
     */
    public function __construct(array $elements = [])
    {
        foreach ($elements as $element) {
            if (!is_string($element)) {
                throw new \InvalidArgumentException('All elements must be strings');
            }
            $this->add($element);
        }
    }

    /**
     * Add an element, duplicates will be ignored
     *
     * @param string $element
     */
    public function add(string $element): void
    {
        if (!in_array($element, $this->elements)) {
            $this->elements[] = $element;
        }
    }

    /**
     * Check to see if an element exists in the lists
     *
     * @param string $element
     * @return bool
     */
    public function has(string $element): bool
    {
        return in_array($element, $this->elements);
    }

    /**
     * Remove an element from the list
     *
     * @param string $element
     */
    public function remove(string $element): void
    {
        $index = array_search($element, $this->elements);

        if ($index !== false) {
            unset($this->elements[$index]);
        }
    }
}
