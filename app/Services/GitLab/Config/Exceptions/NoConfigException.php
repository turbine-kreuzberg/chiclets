<?php

namespace App\Services\GitLab\Config\Exceptions;

use Exception;
use Throwable;

class NoConfigException extends Exception
{
    public function __construct(int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct("config not present", $code, $previous);
    }
}
