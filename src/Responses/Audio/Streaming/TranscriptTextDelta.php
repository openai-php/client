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
 * @phpstan-import-type LogprobsType from Logprobs
 *
 * @phpstan-type TranscriptTextDeltaType array{logprobs?: array<int, LogprobsType>|null, delta: string}
 *
 * @implements ResponseContract<TranscriptTextDeltaType>
 */
final class TranscriptTextDelta implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<TranscriptTextDeltaType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  array<int, Logprobs>|null  $logprobs
     */
    private function __construct(
        public readonly ?array $logprobs,
        public readonly string $delta,
        public readonly MetaInformation $meta,
    ) {}

    /**
     * @param  TranscriptTextDeltaType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        if (isset($attributes['logprobs'])) {
            $logprobs = array_map(
                fn (array $logprob): Logprobs => Logprobs::from($logprob, $meta),
                $attributes['logprobs']
            );
        }

        return new self(
            logprobs: $logprobs ?? null,
            delta: $attributes['delta'],
            meta: $meta,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'logprobs' => $this->logprobs ? array_map(
                fn (Logprobs $logprob): array => $logprob->toArray(),
                $this->logprobs
            ) : null,
            'delta' => $this->delta,
        ];
    }
}
