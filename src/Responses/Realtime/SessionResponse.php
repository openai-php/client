<?php

declare(strict_types=1);

namespace OpenAI\Responses\Realtime;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Realtime\Session\ClientSecret;
use OpenAI\Responses\Realtime\Session\InputAudioTranscription;
use OpenAI\Responses\Realtime\Session\TurnDetection;
use OpenAI\Responses\Realtime\Tools\FunctionTool;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type ClientSecretType from ClientSecret
 * @phpstan-import-type InputAudioTranscriptionType from InputAudioTranscription
 * @phpstan-import-type TurnDetectionType from TurnDetection
 * @phpstan-import-type FunctionToolType from FunctionTool
 *
 * @phpstan-type SessionType array{client_secret: ClientSecretType, input_audio_format: 'pcm16'|'g711_ulaw'|'g711_alaw', input_audio_transcription: InputAudioTranscriptionType|null, instructions: string,  max_response_output_tokens: int|'inf', modalities: array<string>, output_audio_format: 'pcm16'|'g711_ulaw'|'g711_alaw', temperature: float, tool_choice: 'auto'|'none'|'required', tools: array<FunctionToolType>, turn_detection: TurnDetectionType|null, voice: 'alloy'|'ash'|'ballad'|'coral'|'echo'|'sage'|'shimmer'|'verse'}
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

    /**
     * @param  'pcm16'|'g711_ulaw'|'g711_alaw'  $inputAudioFormat
     * @param  int|'inf'  $maxResponseOutputTokens
     * @param  array<string>  $modalities
     * @param  'pcm16'|'g711_ulaw'|'g711_alaw'  $outputAudioFormat
     * @param  'auto'|'none'|'required'  $toolChoice
     * @param  array<FunctionTool>  $tools
     * @param  'alloy'|'ash'|'ballad'|'coral'|'echo'|'sage'|'shimmer'|'verse'  $voice
     */
    private function __construct(
        public readonly ClientSecret $clientSecret,
        public readonly string $inputAudioFormat,
        public readonly ?InputAudioTranscription $inputAudioTranscription,
        public readonly string $instructions,
        public readonly int|string $maxResponseOutputTokens,
        public readonly array $modalities,
        public readonly string $outputAudioFormat,
        public readonly float $temperature,
        public readonly string $toolChoice,
        public readonly array $tools,
        public readonly ?TurnDetection $turnDetection,
        public readonly string $voice,
    ) {}

    /**
     * @param  SessionType  $attributes
     */
    public static function from(array $attributes): self
    {
        $tools = array_map(
            fn (array $tool): FunctionTool => match ($tool['type']) {
                'function' => FunctionTool::from($tool),
            },
            $attributes['tools']
        );

        return new self(
            clientSecret: ClientSecret::from($attributes['client_secret']),
            inputAudioFormat: $attributes['input_audio_format'],
            inputAudioTranscription: isset($attributes['input_audio_transcription'])
                ? InputAudioTranscription::from($attributes['input_audio_transcription'])
                : null,
            instructions: $attributes['instructions'],
            maxResponseOutputTokens: $attributes['max_response_output_tokens'],
            modalities: $attributes['modalities'],
            outputAudioFormat: $attributes['output_audio_format'],
            temperature: $attributes['temperature'],
            toolChoice: $attributes['tool_choice'],
            tools: $tools,
            turnDetection: isset($attributes['turn_detection'])
                ? TurnDetection::from($attributes['turn_detection'])
                : null,
            voice: $attributes['voice'],
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
            'instructions' => $this->instructions,
            'max_response_output_tokens' => $this->maxResponseOutputTokens,
            'modalities' => $this->modalities,
            'output_audio_format' => $this->outputAudioFormat,
            'temperature' => $this->temperature,
            'tool_choice' => $this->toolChoice,
            'tools' => array_map(
                static fn (FunctionTool $tool): array => $tool->toArray(),
                $this->tools,
            ),
            'turn_detection' => $this->turnDetection?->toArray(),
            'voice' => $this->voice,
        ];
    }
}
