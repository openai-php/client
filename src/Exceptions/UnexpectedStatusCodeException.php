<?php

declare(strict_types=1);

namespace OpenAI\Exceptions;

use Exception;

final class UnexpectedStatusCodeException extends Exception
{
    /**
     * Creates a new Exception instance.
     *
     * @param int $statusCode The HTTP status code.
     */

    public function __construct(int $statusCode)
    {
        $message = "Unexpected status code: {$statusCode}";

        parent::__construct($message, $statusCode);
    }
}
