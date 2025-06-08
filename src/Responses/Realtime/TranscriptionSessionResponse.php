<?php

declare(strict_types=1);

namespace OpenAI\Responses\Realtime;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Realtime\Session\ClientSecret;
use OpenAI\Responses\Realtime\Session\TurnDetection;
use OpenAI\Responses\Realtime\Tools\FunctionTool;
use OpenAI\Responses\Realtime\TranscriptionSession\InputAudioTranscription;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type ClientSecretType from ClientSecret
 * @phpstan-import-type InputAudioTranscriptionType from InputAudioTranscription
 * @phpstan-import-type TurnDetectionType from TurnDetection
 * @phpstan-import-type FunctionToolType from FunctionTool
 *
 * @phpstan-type TranscriptionSessionType array{client_secret: ClientSecretType, input_audio_format: 'pcm16'|'g711_ulaw'|'g711_alaw', input_audio_transcription: InputAudioTranscriptionType|null, modalities: array<string>|null, turn_detection: TurnDetectionType|null}
 *
 * @implements ResponseContract<TranscriptionSessionType>
 */
final class TranscriptionSessionResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<TranscriptionSessionType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'pcm16'|'g711_ulaw'|'g711_alaw'  $inputAudioFormat
     * @param  array<string>|null  $modalities
     */
    private function __construct(
        public readonly ClientSecret $clientSecret,
        public readonly string $inputAudioFormat,
        public readonly ?InputAudioTranscription $inputAudioTranscription,
        public readonly ?array $modalities,
        public readonly ?TurnDetection $turnDetection,
    ) {}

    /**
     * @param  TranscriptionSessionType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            clientSecret: ClientSecret::from($attributes['client_secret']),
            inputAudioFormat: $attributes['input_audio_format'],
            inputAudioTranscription: isset($attributes['input_audio_transcription'])
                ? InputAudioTranscription::from($attributes['input_audio_transcription'])
                : null,
            modalities: $attributes['modalities'] ?? null,
            turnDetection: isset($attributes['turn_detection'])
                ? TurnDetection::from($attributes['turn_detection'])
                : null,
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
            'input_audio_transcription' => $this->inputAudioTranscription?->toArray(),
            'modalities' => $this->modalities,
            'turn_detection' => $this->turnDetection?->toArray(),
        ];
    }
}
