<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type CreateResponseChoiceAudioType array{id: string, data: string, expires_at: int, transcript: string}
 *
 * @implements ResponseContract<CreateResponseChoiceAudioType>
 */
final class CreateResponseChoiceAudio implements ResponseContract
{
    /**
     * @use ArrayAccessible<CreateResponseChoiceAudioType>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public readonly string $id,
        public readonly string $data,
        public readonly int $expiresAt,
        public readonly string $transcript,
    ) {}

    /**
     * @param  CreateResponseChoiceAudioType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            id: $attributes['id'],
            data: $attributes['data'],
            expiresAt: $attributes['expires_at'],
            transcript: $attributes['transcript'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'data' => $this->data,
            'expires_at' => $this->expiresAt,
            'transcript' => $this->transcript,
        ];
    }
}
