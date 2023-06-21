<?php declare(strict_types=1);
/**
 * The TimeKeeper.
 * Copyright 2023 Automattic, Inc.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 */

namespace Tumblr\Tests\Chorus;

use PHPUnit\Framework\TestCase;
use Tumblr\Chorus;

use function microtime;
use function time;

/**
 * Test `TimeKeeper`
 */
class TimeKeeperTest extends TestCase
{
    /**
     * Test `getCurrentUnixTime`
     */
    public function testGetCurrentUnixTime(): void
    {
        $time_keeper = new Chorus\TimeKeeper();
        $this->assertGreaterThanOrEqual(time(), $time_keeper->getCurrentUnixTime());
        $this->assertGreaterThanOrEqual(microtime(true), $time_keeper->getCurrentTimeAsFloat());
        $this->assertGreaterThanOrEqual((int) (microtime(true) * 1000000), $time_keeper->getMicrosecondCurrentTime());
    }
}
