<?php

namespace Tests\Unit;

use Nanotime\Nanotime;
use PHPUnit\Framework\TestCase;

/**
 * @covers Nanotime
 */
final class NanotimeTest extends TestCase
{
    const MICRO_INVERSE_FACTOR = 1000000;

    public function testDiffGetsExpectedDiffInterval()
    {
        $start = microtime(true);
        $firstMoment = Nanotime::now();
        usleep(100);
        $secondMoment = Nanotime::now();
        $end = microtime(true);

        $this->assertGreaterThan(
            $secondMoment->diff($firstMoment)->microtime(),
            ($end - $start) * self::MICRO_INVERSE_FACTOR
        );
    }
}
