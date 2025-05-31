<?php

declare(strict_types=1);

namespace OpenAI\Responses\Realtime\Session;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type TurnDetectionType array{prefix_padding_ms: int, silence_duration_ms: int, threshold: float, type: 'server_vad'}
 *
 * @implements ResponseContract<TurnDetectionType>
 */
final class TurnDetection implements ResponseContract
{
    /**
     * @use ArrayAccessible<TurnDetectionType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'server_vad'  $type
     */
    private function __construct(
        public readonly int $prefixPaddingMs,
        public readonly int $silenceDurationMs,
        public readonly float $threshold,
        public readonly string $type,
    ) {}

    /**
     * @param  TurnDetectionType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            prefixPaddingMs: $attributes['prefix_padding_ms'],
            silenceDurationMs: $attributes['silence_duration_ms'],
            threshold: $attributes['threshold'],
            type: $attributes['type'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'prefix_padding_ms' => $this->prefixPaddingMs,
            'silence_duration_ms' => $this->silenceDurationMs,
            'threshold' => $this->threshold,
            'type' => $this->type,
        ];
    }
}
