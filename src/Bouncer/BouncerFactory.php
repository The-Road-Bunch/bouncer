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
    public static function create(Rule $rule, array|string $subjects = []): BouncerInterface
    {
        if (is_string($subjects)) {
            $trimmed = [];
            foreach (explode(';', $subjects) as $subject) {
                if (!empty($subject)) {
                    $trimmed[] = trim($subject);
                }
            }
            $subjects = $trimmed;
        }
        return match ($rule) {
            Rule::ALLOW => new AllowList($subjects),
            Rule::DENY => new DenyList($subjects),
        };
    }

    public static function createAllow(array|string $subjects = []): BouncerInterface
    {
        return self::create(Rule::ALLOW, $subjects);
    }

    public static function createDeny(array|string $subjects = []): BouncerInterface
    {
        return self::create(Rule::DENY, $subjects);
    }
}
