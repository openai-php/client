<?php

declare(strict_types=1);

namespace OpenAI\Responses\Agents\Environments\Objects;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type NetworkType array{access: string, allowed_domains: array<int, string>}
 *
 * @implements ResponseContract<NetworkType>
 */
final class Network implements ResponseContract
{
    /**
     * @use ArrayAccessible<NetworkType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, string>  $allowedDomains
     */
    private function __construct(
        public readonly string $access,
        public readonly array $allowedDomains,
    ) {}

    /**
     * @param  NetworkType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            access: $attributes['access'],
            allowedDomains: $attributes['allowed_domains'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'access' => $this->access,
            'allowed_domains' => $this->allowedDomains,
        ];
    }
}
