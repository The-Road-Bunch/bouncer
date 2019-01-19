<?php
/**
 * This file is part of the theroadbunch/filter-lists package.
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
    const TYPE_WHITELIST = 'whitelist';
    const TYPE_BLACKLIST = 'blacklist';

    protected $type;

    /**
     * FilterList constructor.
     *
     * @param string   $type
     * @param string[] $elements An array of strings
     */
    public function __construct(string $type, array $elements = [])
    {
        $this->type = $type;
        parent::__construct($elements);
    }

    /**
     * The list type
     *
     * @return string
     */
    public function name(): string
    {
        return $this->type;
    }
}