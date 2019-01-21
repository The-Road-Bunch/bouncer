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


/**
 * Class Whitelist
 *
 * @author  Dan McAdams
 * @package RoadBunch\Lists
 */
class Whitelist extends NamedStringCollection
{
    public function __construct(array $elements = [])
    {
        parent::__construct(Bouncer::WHITELIST, $elements);
    }
}
