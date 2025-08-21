<?php

declare(strict_types=1);

namespace OpenAI\Exceptions;

use Exception;
use Psr\Http\Message\ResponseInterface;

final class RateLimitException extends Exception
{
    public function __construct(public ResponseInterface $response)
    {
        parent::__construct('Request rate limit has been exceeded.');
    }
}
