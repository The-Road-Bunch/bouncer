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


class BlacklistValidator
{
    /**
     * @var FilterList
     */
    protected $filterList;

    /**
     * BlacklistValidator constructor.
     *
     * @param FilterListInterface $filterList
     *
     * @throws InvalidListTypeException
     */
    public function __construct(FilterListInterface $filterList)
    {
        $validListTypes = [FilterList::TYPE_BLACKLIST, FilterList::TYPE_WHITELIST];

        if (!in_array($filterList->getType(), $validListTypes)) {
            throw new InvalidListTypeException("The provided FilterList must be of type 'whitelist' or 'blacklist'");
        }
        $this->filterList = $filterList;
    }

    /**
     * Checks the string against a blacklist or a white list
     *
     * @param string $element
     *
     * @return bool Returns true if the element is not found in the whitelist and true if found in the blacklist
     */
    public function isBlacklisted(string $element): bool
    {
        if (FilterList::TYPE_WHITELIST === $this->filterList->getType()) {
            return !$this->filterList->has($element);
        }
        return $this->filterList->has($element);
    }
}
