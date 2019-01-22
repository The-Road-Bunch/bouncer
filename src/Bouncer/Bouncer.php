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


use RoadBunch\String\NamedStringCollectionInterface;

/**
 * Class Bouncer
 *
 * @author  Dan McAdams
 * @package RoadBunch\Bouncer
 */
class Bouncer
{
    const BLACKLIST = 'blacklist';
    const WHITELIST = 'whitelist';

    /**
     * @var NamedStringCollectionInterface
     */
    protected $filterList;

    /**
     * BlacklistValidator constructor.
     *
     * @param NamedStringCollectionInterface $filterList
     *
     * @throws InvalidCollectionNameException
     */
    public function __construct(NamedStringCollectionInterface $filterList = null)
    {
        if ($filterList !== null) {
            $this->validateListType($filterList);
        }
        $this->filterList = $filterList ?? new Blacklist();
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
        if ($this->hasBlacklist()) {
            return $this->filterList->has($element);
        }
        return !$this->filterList->has($element);
    }

    /**
     * Returns the opposite of isBlacklisted
     *
     * @param string $element
     *
     * @return bool
     */
    public function isAllowed(string $element): bool
    {
        return !$this->isBlacklisted($element);
    }

    /**
     * @param string $element
     */
    public function addToWhitelist(string $element): void
    {
        if ($this->hasBlacklist()) {
            $this->filterList->remove($element);
            return;
        }
        $this->filterList->add($element);
    }

    /**
     * @param string $element
     */
    public function addToBlacklist(string $element): void
    {
        if ($this->hasBlacklist()) {
            $this->filterList->add($element);
            return;
        }
        $this->filterList->remove($element);
    }

    /**
     * @return bool
     */
    private function hasBlacklist(): bool
    {
        return $this->filterList->name() === self::BLACKLIST;
    }

    /**
     * @param NamedStringCollectionInterface $filterList
     *
     * @throws InvalidCollectionNameException
     */
    private function validateListType(NamedStringCollectionInterface $filterList): void
    {
        $validListTypes = [self::BLACKLIST, self::WHITELIST];

        if (!in_array($filterList->name(), $validListTypes)) {
            throw new InvalidCollectionNameException("The provided FilterList must be of type 'whitelist' or 'blacklist'");
        }
    }
}
