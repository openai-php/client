<?php

declare(strict_types=1);

namespace OpenAI\Responses\Realtime\TranscriptionSession;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type InputAudioTranscriptionType array{language: string, model: 'gpt-4o-transcribe'|'gpt-4o-mini-transcribe'|'whisper-1', prompt: string}
 *
 * @implements ResponseContract<InputAudioTranscriptionType>
 */
final class InputAudioTranscription implements ResponseContract
{
    /**
     * @use ArrayAccessible<InputAudioTranscriptionType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'gpt-4o-transcribe'|'gpt-4o-mini-transcribe'|"whisper-1"  $model
     */
    private function __construct(
        public readonly string $language,
        public readonly string $model,
        public readonly string $prompt,
    ) {}

    /**
     * @param  InputAudioTranscriptionType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            language: $attributes['language'],
            model: $attributes['model'],
            prompt: $attributes['prompt'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'language' => $this->language,
            'model' => $this->model,
            'prompt' => $this->prompt,
        ];
    }
}
