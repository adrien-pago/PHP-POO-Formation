<?php

namespace App\Auth;

use RuntimeException;
use Throwable;

class AuthException extends RuntimeException
{
    public static function invalidCredentials(Throwable|null $previous = null): self
    {
        return new self('Invalid credentials', previous: $previous);
    }
}
