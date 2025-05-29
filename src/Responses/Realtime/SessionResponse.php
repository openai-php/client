<?php

declare(strict_types=1);

namespace OpenAI\Responses\Realtime;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type ClientSecretType from SessionClientSecret
 *
 * @phpstan-type SessionType array{client_secret: ClientSecretType, input_audio_format: 'pcm16'|'g711_ulaw'|'g711_alaw'}
 *
 * @implements ResponseContract<SessionType>
 */
final class SessionResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<SessionType>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public readonly SessionClientSecret $clientSecret,
        public readonly string $inputAudioFormat,
    ) {}

    /**
     * @param  SessionType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            clientSecret: SessionClientSecret::from($attributes['client_secret']),
            inputAudioFormat: $attributes['input_audio_format'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'client_secret' => $this->clientSecret->toArray(),
            'input_audio_format' => $this->inputAudioFormat,
        ];
    }
}
