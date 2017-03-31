<?php

namespace Nanotime\Exceptions;

use InvalidArgumentException;

final class InvalidNanotimeInterval extends InvalidArgumentException
{
    public static function create($nanotimeInterval)
    {
        return new self(sprintf('Invalid nanotime interval. Got %s.', $nanotimeInterval));
    }
}
