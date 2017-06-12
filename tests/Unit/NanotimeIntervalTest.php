<?php

namespace NanotimeTests\Unit;

use Nanotime\Exceptions\InvalidNanotimeInterval;
use Nanotime\Nanotime;
use Nanotime\NanotimeInterval;
use PHPUnit\Framework\TestCase;

/**
 * @covers NanotimeInterval
 */
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

    /**
     * @dataProvider nanointernvalDifferences
     */
    public function testNanotimeIntervals($endNanotimestamp, $startNanotimestamp, $diff)
    {
        $startNanotime = Nanotime::create($startNanotimestamp);
        $endNanotime =   Nanotime::create($endNanotimestamp);

        NanotimeInterval::create($startNanotime, $endNanotime);

        $this->assertEquals($diff, $endNanotime->diff($startNanotime)->nanotime());
    }

    public function nanointernvalDifferences()
    {
        return [
            ['1257894000000000000', '1257893000000000001', 999999999999],
            ['1257894000000000000', '1257893000000000010', 999999999990],
            ['1257894000000000000', '1257893000000000100', 999999999900],
            ['1257894000000000000', '1257893000000001000', 999999999000],
            ['1257894000000000000', '1257893000000010000', 999999990000],
            ['1257894000000000000', '1257893000000100000', 999999900000],
            ['1257894000000000000', '1257893000001000000', 999999000000],
            ['1257894000000000000', '1257893000010000000', 999990000000],
            ['1257894000000000000', '1257893000100000000', 999900000000],
            ['1257894000000000000', '1257893001000000000', 999000000000],
            ['1257894000000000000', '1257893010000000000', 990000000000],
            ['1257894000000000000', '1257893100000000000', 900000000000],
        ];
    }
}
