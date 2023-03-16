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


use JetBrains\PhpStorm\Deprecated;

/**
 * Class BouncerFactory
 *
 * @author Dan McAdams <dan.mcadams@gmail.com>
 */
#[Deprecated(
    reason: 'Documentation will be removed in v2.4. Use Bouncer::allow or Bouncer::deny instead',
    replacement: "Use Bouncer::allow or Bouncer::deny instead"
)]
class BouncerFactory
{
    public static function create(Rule $rule, array|string $subjects = []): BouncerInterface
    {
        return match ($rule) {
            Rule::ALLOW => new AllowBouncer($subjects),
            Rule::DENY => new DenyBouncer($subjects),
        };
    }
}
