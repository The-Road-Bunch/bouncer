<?php
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
 * Class FilterList
 *
 * @author  Dan McAdams
 * @package RoadBunch\Domain
 */
class NamedStringCollection extends StringCollection implements NamedStringCollectionInterface
{
    protected $name;

    /**
     * FilterList constructor.
     *
     * @param string   $name
     * @param string[] $elements An array of strings
     */
    public function __construct(string $name, array $elements = [])
    {
        $this->name = $name;
        parent::__construct($elements);
    }

    /**
     * The list name
     *
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }
}
