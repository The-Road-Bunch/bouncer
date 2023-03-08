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
 * Class BouncerFactory
 *
 * @author Dan McAdams <dan.mcadams@gmail.com>
 */
class BouncerFactory
{
    public static function create(Rule $rule, array $subjects = []): BouncerInterface
    {
        return match ($rule) {
            Rule::ALLOW => new AllowList($subjects),
            Rule::DENY => new DenyList($subjects),
        };
    }
}
