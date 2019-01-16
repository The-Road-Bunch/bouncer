<?php
/**
 * This file is part of the theroadbunch/filter-lists package.
 *
 * (c) Dan McAdams <danmcadams@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RoadBunch\Lists;


/**
 * Class ListFactory
 *
 * @author  Dan McAdams
 * @package RoadBunch\Lists
 */
class ListFactory
{
    /**
     * Create a FilterList with the type of FilterList::TYPE_WHITELIST
     *
     * @param array $elements
     * @return FilterListInterface
     * @throws NonStringException
     */
    public static function createWhitelist(array $elements = []): FilterListInterface
    {
        return new Whitelist($elements);
    }

    /**
     * Create a FilterList with the type of FilterList::TYPE_BLACKLIST
     *
     * @param array $elements
     * @return FilterListInterface
     * @throws NonStringException
     */
    public static function createBlacklist(array $elements = []): FilterListInterface
    {
        return new Blacklist($elements);
    }
}
