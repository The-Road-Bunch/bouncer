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
    public static function create(string $type, array $domains = [])
    {
        switch (strtolower($type)) {
            case (FilterList::TYPE_WHITELIST):
                return new Whitelist($domains);
            case (FilterList::TYPE_BLACKLIST):
                return new Blacklist($domains);
            default:
                throw new InvalidListTypeException($type . ' is not a valid list type.');
        }
    }
}
