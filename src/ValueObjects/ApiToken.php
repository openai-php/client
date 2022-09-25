<?php

declare(strict_types=1);

namespace OpenAI\ValueObjects;

use OpenAI\Contracts\Stringable;

/**
 * @internal
 */
final class ApiToken implements Stringable
{
    /**
     * Creates a new API token value object.
     */
    private function __construct(public readonly string $apiToken)
    {
        // ..
    }

    public static function from(string $apiToken): self
    {
        return new self($apiToken);
    }

    /**
     * {@inheritdoc}
     */
    public function toString(): string
    {
        return $this->apiToken;
    }
}
