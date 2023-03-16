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

namespace RoadBunch\Tests\Bouncer;


use RoadBunch\Bouncer\DenyBouncer;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Class DenyBouncerTest
 *
 * @author Dan McAdams <dan.mcadams@gmail.com>
 */
#[CoversClass(DenyBouncer::class)]
final class DenyBouncerTest extends TestCase
{
    #[Test]
    public function createDenyList()
    {
        $domain = 'denied';
        $bouncer = new DenyBouncer([$domain]);

        $this->assertFalse($bouncer->isAllowed($domain));
    }

    #[Test]
    public function allowRemovesStringFromDenyList(): void
    {
        $domain = 'denied';
        $bouncer = new DenyBouncer([$domain]);

        $this->assertFalse($bouncer->isAllowed($domain));

        $bouncer->allow($domain);
        $this->assertTrue($bouncer->isAllowed($domain));
    }

    #[Test]
    public function denyAddsStringToDenyList(): void
    {
        $domain = 'denied';
        $bouncer = new DenyBouncer();

        $this->assertTrue($bouncer->isAllowed($domain));

        $bouncer->deny($domain);
        $this->assertFalse($bouncer->isAllowed($domain));
    }

    #[Test]
    public function withDuplicateString(): void
    {
        $bouncer = new DenyBouncer(['d', 'd']);
        $this->assertFalse($bouncer->isAllowed('d'));

        $bouncer->allow('d');
        $this->assertTrue($bouncer->isAllowed('d'));
    }
}
