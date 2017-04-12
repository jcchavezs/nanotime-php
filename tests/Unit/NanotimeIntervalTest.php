<?php

namespace Tests\Unit;

use Nanotime\Exceptions\InvalidNanotimeInterval;
use Nanotime\Nanotime;
use Nanotime\NanotimeInterval;
use PHPUnit\Framework\TestCase;

final class NanotimeIntervalTest extends TestCase
{
    const TEN_NANOSECONDS_IN_SECONDS = 0;
    const TEN_NANOSECONDS_IN_MICROSECONDS = 0;
    const TEN_NANOSECONDS_IN_NANOSECONDS = 10;
    const TEN_MICROSECONDS_IN_NANOSECONDS = 10000;
    const TEN_MICROSECONDS_IN_MICROSECONDS = 10;
    const TEN_MICROSECONDS_IN_SECONDS = 0;
    const TEN_SECONDS_IN_NANOSECONDS = 10000000000;
    const TEN_SECONDS_IN_MICROSECONDS = 10000000;
    const TEN_SECONDS_IN_SECONDS = 10;

    public function testNanotimeIntervalFailsOnCreation()
    {
        $endNanotime = Nanotime::now();
        usleep(1);
        $startNanotime = Nanotime::now();

        $this->expectException(InvalidNanotimeInterval::class);

        NanotimeInterval::create($startNanotime, $endNanotime);
    }

    public function testNanotimeIntervalIsCreatedSuccessfullyWithNanosecondsInDifference()
    {
        $startNanotime = Nanotime::create('1257894000000000000');
        $endNanotime =   Nanotime::create('1257894000000000010');

        NanotimeInterval::create($startNanotime, $endNanotime);

        $this->assertEquals(self::TEN_NANOSECONDS_IN_NANOSECONDS, $endNanotime->diff($startNanotime)->nanotime());
        $this->assertEquals(self::TEN_NANOSECONDS_IN_MICROSECONDS, $endNanotime->diff($startNanotime)->microtime());
        $this->assertEquals(self::TEN_NANOSECONDS_IN_SECONDS, $endNanotime->diff($startNanotime)->time());
    }

    public function testNanotimeIntervalIsCreatedSuccessfullyWithMicrosecondsInDifference()
    {
        $startNanotime = Nanotime::create('1257894000000000000');
        $endNanotime =   Nanotime::create('1257894000000010000');

        NanotimeInterval::create($startNanotime, $endNanotime);

        $this->assertEquals(self::TEN_MICROSECONDS_IN_NANOSECONDS, $endNanotime->diff($startNanotime)->nanotime());
        $this->assertEquals(self::TEN_MICROSECONDS_IN_MICROSECONDS, $endNanotime->diff($startNanotime)->microtime());
        $this->assertEquals(self::TEN_MICROSECONDS_IN_SECONDS, $endNanotime->diff($startNanotime)->time());
    }

    public function testNanotimeIntervalIsCreatedSuccessfullyWithSecondsInDifference()
    {
        $startNanotime = Nanotime::create('1257894000000000000');
        $endNanotime =   Nanotime::create('1257894010000000000');

        NanotimeInterval::create($startNanotime, $endNanotime);

        $this->assertEquals(self::TEN_SECONDS_IN_NANOSECONDS, $endNanotime->diff($startNanotime)->nanotime());
        $this->assertEquals(self::TEN_SECONDS_IN_MICROSECONDS, $endNanotime->diff($startNanotime)->microtime());
        $this->assertEquals(self::TEN_SECONDS_IN_SECONDS, $endNanotime->diff($startNanotime)->time());
    }
}
