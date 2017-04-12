<?php

namespace Nanotime\Exceptions;

use InvalidArgumentException;
use Nanotime\Nanotime;

final class InvalidNanotimeInterval extends InvalidArgumentException
{
    public static function withNanotimes(Nanotime $startNanotime, Nanotime $endNanotime)
    {
        return new self(
            sprintf(
                'End nanotime %s should be greater than start nanotime %s.',
                $endNanotime->nanotime(),
                $startNanotime->nanotime()
            )
        );
    }
}
