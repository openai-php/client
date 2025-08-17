<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\AudioContract;
use OpenAI\Responses\Audio\SpeechStreamResponse;
use OpenAI\Responses\Audio\TranscriptionResponse;
use OpenAI\Responses\Audio\TranscriptionStreamResponse;
use OpenAI\Responses\Audio\TranslationResponse;
use OpenAI\Responses\StreamResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

final class Audio implements AudioContract
{
    use Concerns\Streamable;
    use Concerns\Transportable;

    /**
     * Generates audio from the input text.
     *
     * @see https://platform.openai.com/docs/api-reference/audio/createSpeech
     *
     * @param  array<string, mixed>  $parameters
     */
    public function speech(array $parameters): string
    {
        $this->ensureNotStreamed($parameters, 'speechStreamed');

        $payload = Payload::create('audio/speech', $parameters);

        return $this->transporter->requestContent($payload);
    }

    /**
     * Generates streamed audio from the input text.
     *
     * @see https://platform.openai.com/docs/api-reference/audio/createSpeech
     *
     * @param  array<string, mixed>  $parameters
     */
    public function speechStreamed(array $parameters): SpeechStreamResponse
    {
        $payload = Payload::create('audio/speech', $parameters);

        $response = $this->transporter->requestStream($payload);

        return new SpeechStreamResponse($response);
    }

    /**
     * Transcribes audio into the input language.
     *
     * @see https://platform.openai.com/docs/api-reference/audio/createTranscription
     *
     * @param  array<string, mixed>  $parameters
     */
    public function transcribe(array $parameters): TranscriptionResponse
    {
        $this->ensureNotStreamed($parameters, 'transcribeStreamed');

        $payload = Payload::upload('audio/transcriptions', $parameters);

        /** @var Response<array{task: ?string, language: ?string, duration: ?float, segments: array<int, array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient?: bool}>, words: array<int, array{word: string, start: float, end: float}>, text: string}> $response */
        $response = $this->transporter->requestStringOrObject($payload);

        return TranscriptionResponse::from($response->data(), $response->meta());
    }

    /**
     * Transcribes audio input the streamed events.
     *
     * @see https://platform.openai.com/docs/api-reference/audio/createTranscription#audio-createtranscription-stream
     *
     * @param  array<string, mixed>  $parameters
     * @return StreamResponse<TranscriptionStreamResponse>
     */
    public function transcribeStreamed(array $parameters): StreamResponse
    {
        $parameters = $this->setStreamParameter($parameters);

        $payload = Payload::upload('audio/transcriptions', $parameters);

        $response = $this->transporter->requestStream($payload);

        return new StreamResponse(TranscriptionStreamResponse::class, $response);
    }

    /**
     * Translates audio into English.
     *
     * @see https://platform.openai.com/docs/api-reference/audio/createTranslation
     *
     * @param  array<string, mixed>  $parameters
     */
    public function translate(array $parameters): TranslationResponse
    {
        $payload = Payload::upload('audio/translations', $parameters);

        /** @var Response<array{task: ?string, language: ?string, duration: ?float, segments: array<int, array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient?: bool}>, text: string}> $response */
        $response = $this->transporter->requestStringOrObject($payload);

        return TranslationResponse::from($response->data(), $response->meta());
    }
}
