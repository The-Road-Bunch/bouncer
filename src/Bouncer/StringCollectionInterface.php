<?php
/**
 * This file is part of the theroadbunch/filter-lists package.
 *
 * (c) Dan McAdams <danmcadams@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RoadBunch\Bouncer;


/**
 * Interface StringCollectionInterface
 *
 * @author  Dan McAdams
 * @package RoadBunch\Lists
 */
interface StringCollectionInterface
{
    /**
     * Add an element, duplicates will be ignored
     *
     * @param string $element
     */
    public function add(string $element): void;

    /**
     * Check to see if an element exists in the lists
     *
     * @param string $element
     * @return bool
     */
    public function has(string $element): bool;

    /**
     * Remove an element from the list
     *
     * @param string $element
     */
    public function remove(string $element): void;
}
