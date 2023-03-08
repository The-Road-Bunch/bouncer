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
 * @author  Dan McAdams
 * @package RoadBunch\Bouncer
 */
interface BouncerInterface
{
    public function isAllowed(string $subject): bool;
    public function allow(string $subject): void;
    public function deny(string $subject): void;
}
