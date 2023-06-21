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

/**
 * Class to override some TimeKeeper stuff and allows you to change the current time "on the fly" using set functions.
 * Sometimes it's a lot easier than rebuilding the whole mock mid-test or creating a tricky mock function that could
 * break with underlying code changes.
 */
class FakeTimeKeeper extends TimeKeeper
{
    /**
     * @var int Current unix time to mimic (int timestamp)
     */
    private int $current_unix_time = 0;

    /**
     * @var float Current unix time to mimic (as a float timestamp)
     */
    private float $current_unix_time_float = 0.0;

    /**
     * @var int Current unix time in microseconds
     */
    private int $current_microsecond_time = 0;

    /**
     * FakeTimeKeeper constructor.
     *
     * @param float|int $current_unix_time Optional unix time to mock time() and microtime(true)
     */
    public function __construct($current_unix_time = 0.0)
    {
        $this->setCurrentUnixTime($current_unix_time);
    }

    /**
     * @param float|int $current_unix_time Current unix timestamp (int seconds) to mimic
     */
    public function setCurrentUnixTime($current_unix_time): void
    {
        $this->current_unix_time = (int) $current_unix_time;
        $this->current_unix_time_float = (float) $current_unix_time;
        $this->current_microsecond_time = (int) ($current_unix_time * self::MICROSECONDS_PER_SECOND);
    }

    public function getCurrentUnixTime(): int
    {
        return $this->current_unix_time;
    }

    public function getCurrentTimeAsFloat(): float
    {
        return $this->current_unix_time_float;
    }

    public function getMicrosecondCurrentTime(): int
    {
        return $this->current_microsecond_time;
    }

    /**
     * Actually does nothing!
     * {@inheritDoc}
     */
    public function sleep(int $seconds)
    {
        return 0;
    }

    /**
     * Actually does nothing!
     * {@inheritDoc}
     */
    public function usleep(int $micro_seconds): void
    {
    }
}
