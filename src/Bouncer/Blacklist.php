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
 * Class Blacklist
 *
 * @author  Dan McAdams
 * @package RoadBunch\Lists
 */
class Blacklist extends NamedStringCollection
{
    public function __construct(array $elements = [])
    {
        parent::__construct(static::TYPE_BLACKLIST, $elements);
    }
}
