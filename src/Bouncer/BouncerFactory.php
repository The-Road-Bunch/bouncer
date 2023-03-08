<?php
declare(strict_types=1);

namespace RoadBunch\Bouncer;


class BouncerFactory
{
    public static function create(Bouncer $type, array $subjects = []): BouncerInterface
    {
        return match ($type) {
            Bouncer::ALLOW => new AllowList($subjects),
            Bouncer::DENY => new BlockList($subjects),
        };
    }
}
