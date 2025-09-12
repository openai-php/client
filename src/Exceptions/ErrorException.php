<?php

declare(strict_types=1);

namespace OpenAI\Exceptions;

use Exception;
use Psr\Http\Message\ResponseInterface;

final class ErrorException extends Exception
{
    private readonly int $statusCode;

    /**
     * Creates a new Exception instance.
     *
     * @param  array{message?: string|array<int, string>, type?: ?string, code?: string|int|null}|string  $contents
     */
    public function __construct(private readonly string|array $contents, public readonly ResponseInterface $response)
    {
        $this->statusCode = $response->getStatusCode();

        // Errors can be a string or an object with message, type, and code
        $contents = is_string($contents) ? ['message' => $contents] : $contents;
        $message = ($contents['message'] ?? null) ?: (string) ($contents['code'] ?? null) ?: 'Unknown error';

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
        return $this->contents['type'] ?? null;
    }

    /**
     * Returns the error code.
     */
    public function getErrorCode(): string|int|null
    {
        return $this->contents['code'] ?? null;
    }
}
