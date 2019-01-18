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
    const BLACKLIST = NamedStringCollection::TYPE_BLACKLIST;
    const WHITELIST = NamedStringCollection::TYPE_WHITELIST;

    /**
     * @var NamedStringCollection
     */
    protected $filterList;

    /**
     * BlacklistValidator constructor.
     *
     * @param NamedStringCollectionInterface $filterList
     *
     * @throws InvalidListTypeException
     */
    public function __construct(NamedStringCollectionInterface $filterList)
    {
        $validListTypes = [self::BLACKLIST, self::WHITELIST];

        if (!in_array($filterList->name(), $validListTypes)) {
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
        if (self::WHITELIST === $this->filterList->name()) {
            return !$this->filterList->has($element);
        }
        return $this->filterList->has($element);
    }
}
