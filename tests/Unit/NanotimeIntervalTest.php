<?php

namespace Tests\Unit;

use Nanotime\Exceptions\InvalidNanotimeInterval;
use Nanotime\Nanotime;
use Nanotime\NanotimeInterval;
use PHPUnit\Framework\TestCase;

final class NanotimeIntervalTest extends TestCase
{
    const HUNDRED_SECONDS_IN_TIME = 100;
    const HUNDRED_SECONDS_IN_MICROTIME = 1000000000;
    const HUNDRED_SECONDS_IN_NANOTIME = 1000000000000;

    public function testNanotimeIntervalFailsOnCreation()
    {
        $endNanotime = Nanotime::now();
        usleep(1);
        $startNanotime = Nanotime::now();

        $this->expectException(InvalidNanotimeInterval::class);

        NanotimeInterval::create($startNanotime, $endNanotime);
    }

    public function testNanotimeIntervalIsCreatedSuccessfully()
    {
        $startNanotime = Nanotime::create('1257894000000000000');
        $endNanotime =   Nanotime::create('1257895000000000000');

        NanotimeInterval::create($startNanotime, $endNanotime);

        $this->assertEquals(self::HUNDRED_SECONDS_IN_NANOTIME, $endNanotime->diff($startNanotime)->nanotime());
        $this->assertEquals(self::HUNDRED_SECONDS_IN_MICROTIME, $endNanotime->diff($startNanotime)->microtime());
        $this->assertEquals(self::HUNDRED_SECONDS_IN_TIME, $endNanotime->diff($startNanotime)->time());
    }
}
