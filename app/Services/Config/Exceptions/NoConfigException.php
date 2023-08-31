<?php

namespace App\Services\Config\Exceptions;

use Exception;
use Throwable;

class NoConfigException extends \RuntimeException
{
    public function __construct(int $code = 0, Throwable $previous = null)
    {
        parent::__construct('config not present', $code, $previous);
    }
}
