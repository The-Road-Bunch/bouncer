<?php
/**
 * This file is part of the theroadbunch/filter-lists package.
 *
 * (c) Dan McAdams <danmcadams@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RoadBunch\Lists;


/**
 * Class FilterList
 *
 * @author  Dan McAdams
 * @package RoadBunch\Domain
 */
abstract class FilterList
{
    protected $elements = [];

    /**
     * FilterList constructor.
     *
     * @param string[] $elements An array of strings
     *
     * @throws \Exception
     */
    public function __construct(array $elements = [])
    {
        foreach ($elements as $str) {
            if (!is_string($str)) {
                throw new \Exception('All elements must be an strings');
            }
        }
        $this->elements = $elements;
    }

    /***
     * @param string $element
     *
     * @return bool returns TRUE if the string is found in the list
     */
    protected function has(string $element): bool
    {
        return in_array($element, $this->elements);
    }

    /**
     * Return true or false based on the rules of the list
     *
     * @param string $element
     *
     * @return bool
     */
    abstract public function validate(string $element): bool;
}
