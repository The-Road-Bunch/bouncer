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
    /** @var string[] $subjectPool */
    private array $subjectPool = [];

    /**
     * Provide an array of strings or a single string value.
     * If a single string is provided, values will be extracted with the delimiter ';'
     *
     * @param string|string[] $subjects
     */
    public function __construct(array|string $subjects = [])
    {
        if (is_string($subjects)) {
            $subjects = $this->subjectsFromString($subjects);
        }
        array_walk($subjects, [$this, 'add']);
    }

    public function has(string $subject): bool
    {
        return in_array($subject, $this->subjectPool);
    }

    public function add(string $subject): void
    {
        if (!$this->has($subject)) {
            $this->subjectPool[] = $subject;
        }
    }

    public function remove(string $subject): void
    {
        $key = array_search($subject, $this->subjectPool);

        if ($key !== false) {
            unset($this->subjectPool[$key]);
        }
    }

    private function subjectsFromString(string $subjects): array
    {
        return array_filter(
            explode(';', $subjects),
            function ($subject) {
                return !empty(trim($subject));
            }
        );
    }
}
