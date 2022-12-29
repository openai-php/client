<?php

declare(strict_types=1);

namespace OpenAI\ValueObjects\Transporter;

use OpenAI\Contracts\Stringable;

/**
 * @internal
 */
final class BaseUri implements Stringable
{
    /**
     * Creates a new Base URI value object.
     */
    private function __construct(private readonly string $baseUri)
    {
        // ..
    }

    /**
     * Creates a new Base URI value object.
     */
    public static function from(string $baseUri): self
    {
        return new self($baseUri);
    }

    /**
     * {@inheritdoc}
     */
    public function toString(): string
    {
        $baseUri = $this->baseUri;
        $baseUriStartsWithProtocol = preg_match('#^https?://.+#', $baseUri) !== 0;
        if (! $baseUriStartsWithProtocol) {
            $baseUri = $this->prefixWithHttps($baseUri);
        }

        if (! str_ends_with('/', $baseUri)) {
            return $this->suffixWithSlash($baseUri);
        }

        return $baseUri;
    }

    private function prefixWithHttps(string $string): string
    {
        return "https://{$string}";
    }

    private function suffixWithSlash(string $string): string
    {
        return "{$string}/";
    }
}
