<?php

namespace Nanotime;

use Nanotime\Exceptions\InvalidNanotimeInterval;

final class NanotimeInterval
{
    const MICRO_TO_NANO_FACTOR = 1000;

    private $nanotimeInterval;

    private function __construct($nanotimeInterval)
    {
        $this->nanotimeInterval = $nanotimeInterval;
    }

    public static function create($nanotimeInterval)
    {
        if (!is_numeric($nanotimeInterval)) {
            throw InvalidNanotimeInterval::create($nanotimeInterval);
        }

        return new self($nanotimeInterval);
    }

    public function nanotime()
    {
        return $this->nanotime();
    }

    public function microtime()
    {
        return (int) ($this->nanotimeInterval / self::MICRO_TO_NANO_FACTOR);
    }

    public function __toString()
    {
        return (string) $this->nanotimeInterval;
    }
}
