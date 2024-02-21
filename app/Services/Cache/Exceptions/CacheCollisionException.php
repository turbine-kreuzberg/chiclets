<?php

namespace App\Services\Cache\Exceptions;

use Exception;
use Psr\Cache\CacheException;
use Throwable;

class CacheCollisionException extends Exception implements CacheException
{
    public function __construct(int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct('cache key collision', $code, $previous);
    }
}
