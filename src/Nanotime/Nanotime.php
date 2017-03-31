<?php

namespace Nanotime;

final class Nanotime
{
    const MICRO_FACTOR = 1000000;
    const NANO_FACTOR = 1000000000;
    const MICRO_TO_NANO_FACTOR = 1000;

    private $microtime;

    private function __construct($microtime)
    {
        $this->microtime = $microtime;
    }

    public static function now()
    {
        $microtime = microtime(true);
        return new self($microtime);
    }

    public function nanotime()
    {
        return $this->microtime * self::NANO_FACTOR;
    }

    public function microtime()
    {
        return $this->microtime;
    }

    public function time()
    {
        return (int) ($this->microtime / self::MICRO_FACTOR);
    }

    public function diff(Nanotime $nanotime)
    {
        return NanotimeInterval::create(
            ($this->microtime - $nanotime->microtime) / self::MICRO_TO_NANO_FACTOR
        );
    }

    public function __toString()
    {
        return (string) ($this->microtime * self::NANO_FACTOR);
    }
}
