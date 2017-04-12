<?php

namespace Nanotime;

use Nanotime\Exceptions\InvalidNanotimeInterval;

final class NanotimeInterval
{
    const TO_NANO_FACTOR = 1000000000;
    const FROM_MICRO_TO_NANO_FACTOR = 1000;
    const NO_DECIMAL_PRECISION = 0;

    private $nInterval;

    private function __construct($nInterval)
    {
        $this->nInterval = $nInterval;
    }

    public static function create(Nanotime $start, Nanotime $end)
    {
        if ($start->nanotime() > $end->nanotime()) {
            throw InvalidNanotimeInterval::withNanotimes($start, $end);
        }

        $nInterval = $end->nanotime() - $start->nanotime();

        return new self($nInterval);
    }

    public function nanotime()
    {
        return $this->nInterval;
    }

    public function microtime()
    {
        return (int) round($this->nInterval / self::FROM_MICRO_TO_NANO_FACTOR, self::NO_DECIMAL_PRECISION, PHP_ROUND_HALF_UP);
    }

    public function time()
    {
        return (int) round($this->nInterval / self::TO_NANO_FACTOR, self::NO_DECIMAL_PRECISION, PHP_ROUND_HALF_UP);
    }

    public function __toString()
    {
        return (string) $this->nInterval;
    }
}
