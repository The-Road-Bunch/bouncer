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
 * Class Whitelist
 *
 * @author  Dan McAdams
 * @package RoadBunch\Lists
 */
class Whitelist extends FilterList
{
    /**
     * Whitelist validation: returns true if the domain IS found in this list
     *
     * @param string $element
     *
     * @return bool
     */
    public function validate(string $element): bool
    {
        return $this->has($element);
    }
}

