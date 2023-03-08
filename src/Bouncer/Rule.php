<?php
declare(strict_types=1);
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
 * Enum Rule
 *
 * @author Dan McAdams <dan.mcadams@gmail.com>
 */
enum Rule
{
    case DENY;
    case ALLOW;
}
