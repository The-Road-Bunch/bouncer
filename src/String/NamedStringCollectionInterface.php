<?php
/**
 * This file is part of the theroadbunch/bouncer package.
 *
 * (c) Dan McAdams <danmcadams@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RoadBunch\String;


/**
 * Interface NamedStringCollectionInterface
 *
 * @author  Dan McAdams
 * @package RoadBunch\String
 */
interface NamedStringCollectionInterface extends StringCollectionInterface
{
    /**
     * The list name
     *
     * @return string
     */
    public function name(): string;
}
