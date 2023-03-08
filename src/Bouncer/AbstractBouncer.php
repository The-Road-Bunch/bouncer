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
 * Class AbstractBouncer
 *
 * @author Dan McAdams <dan.mcadams@gmail.com>
 */
abstract class AbstractBouncer implements BouncerInterface
{
    /** @var string[] $items */
    private array $items = [];

    /** @param string[] $items */
    public function __construct(array $items = [])
    {
        foreach ($items as $subject) {
            $this->add($subject);
        }
    }

    public function has(string $subject): bool
    {
        return in_array($subject, $this->items);
    }

    public function add(string $subject): void
    {
        if (!$this->has($subject)) {
            $this->items[] = $subject;
        }
    }

    public function remove(string $subject): void
    {
        $key = array_search($subject, $this->items);

        if ($key !== false) {
            unset($this->items[$key]);
        }
    }
}
