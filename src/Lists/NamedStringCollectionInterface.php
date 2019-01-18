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
 * Interface FilterListInterface
 *
 * @author  Dan McAdams
 * @package RoadBunch\Lists
 */
interface NamedStringCollectionInterface extends StringCollectionInterface
{
    /**
     * The list type
     *
     * @return string
     */
    public function getType(): string;
}
