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
            case ('whitelist'):
                return new Whitelist($domains);
            case ('blacklist'):
                return new Blacklist($domains);
        }
        throw new InvalidListTypeException($type . ' is not a valid list type.');
    }
}
