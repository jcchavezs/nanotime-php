<?php

namespace NanotimeTests\Unit;

use DateTime;
use Nanotime\Nanotime;
use PHPUnit\Framework\TestCase;

/**
 * @covers Nanotime
 */
final class NanotimeTest extends TestCase
{
    const MICRO_INVERSE_FACTOR = 1000000;

    public function testNanotimeCreationSuccessWithDateTime()
    {
        $now = new DateTime();
        $nowAsNanotime = Nanotime::create($now);
        $this->assertEquals($now->format('U'), $nowAsNanotime->time());
        $this->assertEquals($now->format('Uu'), $nowAsNanotime->microtime());
    }

    public function testNanotimeCreationSuccessWithNanotime()
    {
        $nanotime = Nanotime::create(1257894001000001000);
        $this->assertEquals(1257894001, $nanotime->time());
        $this->assertEquals(1257894001000001, $nanotime->microtime());
        $this->assertEquals(1257894001000001000, $nanotime->nanotime());
    }


    public function testNanotimeCreationSuccessWithFloatTime()
    {
        $nanotime = Nanotime::create(1257894001.000001);
        $this->assertEquals(1257894001, $nanotime->time());
        $this->assertEquals(1257894001000001, $nanotime->microtime());
        $this->assertEquals(1257894001000001000, $nanotime->nanotime());
    }

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
