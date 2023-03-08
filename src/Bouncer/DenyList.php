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
 * Class DenyList
 *
 * @author Dan McAdams <dan.mcadams@gmail.com>
 */
class DenyList extends AbstractBouncer
{
    public function isAllowed(string $subject): bool
    {
        return !$this->has($subject);
    }

    public function allow(string $subject): void
    {
        $this->remove($subject);
    }

    public function deny(string $subject): void
    {
        $this->add($subject);
    }
}
