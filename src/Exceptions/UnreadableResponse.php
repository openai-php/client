<?php

declare(strict_types=1);

namespace OpenAI\Exceptions;

use Exception;
use RuntimeException;

final class UnreadableResponse extends Exception implements OpenAIThrowable
{
    /**
     * Creates a new Exception instance.
     */
    public function __construct(RuntimeException $exception)
    {
        parent::__construct($exception->getMessage(), 0, $exception);
    }
}
