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
 * Class Bouncer
 *
 * @author Dan McAdams <dan.mcadams@gmail.com>
 */
class Bouncer
{
    public static function allow(array|string $subjects = []):  BouncerInterface
    {
        return new AllowBouncer($subjects);
    }

    public static function deny(array|string $subjects = []): BouncerInterface
    {
        return new DenyBouncer($subjects);
    }
}
