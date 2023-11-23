<?php

declare(strict_types=1);

namespace Framework\Exceptions;

use RunTimeException;

class ValidationException extends  RunTimeException
{
    public function __construct(public array $errors, int $code = 422)
    {
        parent::__construct(code: $code);
    }
}
