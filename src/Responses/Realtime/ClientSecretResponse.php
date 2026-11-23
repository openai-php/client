<?php

declare(strict_types=1);

namespace OpenAI\Responses\Realtime;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type ClientSecretResponseType array{value: string, expires_at: int, session: array<string, mixed>}
 *
 * @implements ResponseContract<ClientSecretResponseType>
 */
final class ClientSecretResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /** @use ArrayAccessible<ClientSecretResponseType> */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  array<string, mixed>  $session
     */
    private function __construct(
        public readonly string $value,
        public readonly int $expiresAt,
        public readonly array $session,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  ClientSecretResponseType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self($attributes['value'], $attributes['expires_at'], $attributes['session'], $meta);
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'value' => $this->value,
            'expires_at' => $this->expiresAt,
            'session' => $this->session,
        ];
    }
}
