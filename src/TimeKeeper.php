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

namespace Tumblr\Chorus;

use function microtime;
use function sleep;
use function time;
use function usleep;

/**
 * A super simple class for DI with timekeeping
 */
class TimeKeeper
{
    /**
     * The number of microseconds in a second
     */
    protected const MICROSECONDS_PER_SECOND = 1000000;

    /**
     * A mockable time-getter for the current time via time()
     *
     * @return int The current unix epoch time in seconds from PHP
     */
    public function getCurrentUnixTime(): int
    {
        return time();
    }

    /**
     * A mockable time-getter for the current number of seconds since unix epoch via microtime(true).
     * Returns seconds with fractional precision as a floating point number.
     */
    public function getCurrentTimeAsFloat(): float
    {
        return microtime(true);
    }

    /**
     * A mockable time-getter for the current time in microseconds via microtime(true)
     *
     * @return int The time in microseconds
     */
    public function getMicrosecondCurrentTime(): int
    {
        return (int) (microtime(true) * self::MICROSECONDS_PER_SECOND);
    }

    /**
     * Invoke a sleep operation.
     *
     * @param int $seconds number of seconds to just sit there and do nothing
     *
     * @return bool|int False on error, zero on success. Num seconds remaining if interrupted.
     *
     * @codeCoverageIgnore
     */
    public function sleep(int $seconds)
    {
        return sleep($seconds);
    }

    /**
     * Invoke an usleep operation.
     *
     * @param int $micro_seconds number of microseconds to just sit there and do nothing
     *
     * @codeCoverageIgnore
     */
    public function usleep(int $micro_seconds): void
    {
        usleep($micro_seconds);
    }
}
