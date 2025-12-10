<?php

namespace OpenAI\Exceptions;

use RuntimeException;

class WebhookVerificationException extends RuntimeException
{
    protected function __construct(string $message, int $code = 0)
    {
        parent::__construct('Failed to verify webhook: '.$message, $code);
    }

    public static function missingRequiredHeader(): self
    {
        return new self('Missing required header', 100);
    }

    public static function noMatchingSignature(): self
    {
        return new self('No matching signature found', 200);
    }

    public static function invalidTimestamp(): self
    {
        return new self('Invalid timestamp', 300);
    }

    public static function timestampMismatch(): self
    {
        return new self('Message timestamp outside tolerance window', 301);
    }
}
