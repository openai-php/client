<?php

declare(strict_types=1);

namespace OpenAI\Responses\Audio\Streaming;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type LogprobsType array{bytes: array<int, string>, logprobs: int, token: string}
 *
 * @implements ResponseContract<LogprobsType>
 */
final class Logprobs implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<LogprobsType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  array<int, string>  $bytes
     */
    private function __construct(
        public readonly array $bytes,
        public readonly int $logprobs,
        public readonly string $token,
        public readonly MetaInformation $meta,
    ) {}

    /**
     * @param  LogprobsType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            bytes: $attributes['bytes'],
            logprobs: $attributes['logprobs'],
            token: $attributes['token'],
            meta: $meta,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'bytes' => $this->bytes,
            'logprobs' => $this->logprobs,
            'token' => $this->token,
        ];
    }
}
