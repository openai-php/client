<?php

declare(strict_types=1);

namespace OpenAI\Exceptions;

use Exception;

final class ErrorException extends Exception
{
    /**
     * Creates a new Exception instance.
     *
     * @param  array{message: string|array<int, string>, type: ?string, code: string|int|null}  $contents
     */
    public function __construct(private readonly array $contents, private readonly int $statusCode)
    {
        $message = ($contents['message'] ?: (string) $this->contents['code']) ?: 'Unknown error';

        if (is_array($message)) {
            $message = implode(PHP_EOL, $message);
        }

        parent::__construct($message);
    }

    /**
     * Returns the HTTP status code.
     *
     * **Note: For streamed requests it might be 200 even in case of an error.**
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Returns the error message.
     */
    public function getErrorMessage(): string
    {
        return $this->getMessage();
    }

    /**
     * Returns the error type.
     */
    public function getErrorType(): ?string
    {
        return $this->contents['type'];
    }

    /**
     * Returns the error code.
     */
    public function getErrorCode(): string|int|null
    {
        return $this->contents['code'];
    }
}
