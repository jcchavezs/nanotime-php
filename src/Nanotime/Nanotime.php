<?php

namespace Nanotime;

final class Nanotime
{
    private $mseconds;
    private $seconds;

    const MICRO_DECIMAL_DIGITS = 6;
    const NANO_DECIMAL_DIGITS = 9;

    private function __construct($seconds, $mseconds)
    {
        $this->seconds = $seconds;
        $this->mseconds = $mseconds;
    }

    public static function now()
    {
        $microtime = microtime();
        list($mseconds, $seconds) = explode(" ", $microtime);
        return new self($seconds, substr($mseconds, 2));
    }

    public function nanotime()
    {
        return (int) $this->nanotimeAsString();
    }

    public function microtime()
    {
        return (int) ($this->seconds . substr($this->mseconds, 0, self::MICRO_DECIMAL_DIGITS));
    }

    public function time()
    {
        return (int) $this->seconds;
    }

    public function diff(Nanotime $nanotime)
    {
        return NanotimeInterval::create(
            $this->nanotime() - $nanotime->nanotime()
        );
    }

    public function __toString()
    {
        return (string) $this->nanotimeAsString();
    }

    private function nanotimeAsString()
    {
        return ($this->seconds . str_pad($this->mseconds, self::NANO_DECIMAL_DIGITS,  "0"));
    }
}
