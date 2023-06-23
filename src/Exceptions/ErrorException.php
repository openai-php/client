<?php

declare(strict_types=1);

namespace OpenAI\Exceptions;

use Exception;

final class ErrorException extends Exception
{
    /**
     * Creates a new Exception instance.
     *
     * @param  array{message: string|array<int, string>, type: ?string, code: ?string}  $contents
     */
    public function __construct(private readonly array $contents)
    {
        $message = ($contents['message'] ?: $this->contents['code']) ?: 'Unknown error';

        if (is_array($message)) {
            $message = implode("\n", $message);
        }

        parent::__construct($message);
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
     * Returns the error type.
     */
    public function getErrorCode(): ?string
    {
        return $this->contents['code'];
    }
}
