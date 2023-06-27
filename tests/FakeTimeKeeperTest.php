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

/**
 * Test `TimeKeeper`
 */
class FakeTimeKeeperTest extends TestCase
{
    /**
     * Test `getCurrentUnixTime`
     */
    public function testGetCurrentUnixTime(): void
    {
        $time_keeper = new Chorus\FakeTimeKeeper(1001.01);
        $this->assertSame(1001, $time_keeper->getCurrentUnixTime());
        $this->assertSame(1001.01, $time_keeper->getCurrentTimeAsFloat());
        $this->assertSame((int) (1001.01 * 1000000), $time_keeper->getMicrosecondCurrentTime());
    }

    /**
     * Test `setCurrentUnixTime`
     */
    public function testSetCurrentUnixTime(): void
    {
        $time_keeper = new Chorus\FakeTimeKeeper(1001.01);
        $time_keeper->setCurrentUnixTime(1234.92);
        $this->assertSame(1234, $time_keeper->getCurrentUnixTime());
        $this->assertSame(1234.92, $time_keeper->getCurrentTimeAsFloat());

        $this->assertSame((int) (1234.92 * 1000000), $time_keeper->getMicrosecondCurrentTime());
    }

    /**
     * Test fake TimeKeeper does not sleep
     */
    public function testSleep(): void
    {
        $time_start = microtime(true);

        $time_keeper = new Chorus\FakeTimeKeeper();
        $this->assertSame(0, $time_keeper->sleep(10000));
        $time_keeper->usleep(1000000000);

        $this->assertLessThan(1.0, microtime(true) - $time_start);
    }

    /**
     * Test default arguments
     */
    public function testDefault(): void
    {
        $time_keeper = new Chorus\FakeTimeKeeper();
        $this->assertSame(0, $time_keeper->getCurrentUnixTime());
    }

    /**
     * Test integer time
     */
    public function testIntegerTime(): void
    {
        $time_keeper = new Chorus\FakeTimeKeeper();
        $time_keeper->setCurrentUnixTime(17);
        $this->assertSame(17, $time_keeper->getCurrentUnixTime());
        $this->assertSame(17.0, $time_keeper->getCurrentTimeAsFloat());
    }
}
