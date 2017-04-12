<?php

namespace Nanotime\Exceptions;

use InvalidArgumentException;

final class InvalidNanotime extends InvalidArgumentException
{
    public static function withNanotime($nanotime)
    {
        return new self(sprintf('Invalid nanotime %s.', $nanotime));
    }
}
