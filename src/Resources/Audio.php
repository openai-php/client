<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\AudioContract;
use OpenAI\Events\RequestHandled;
use OpenAI\Responses\Audio\SpeechStreamResponse;
use OpenAI\Responses\Audio\TranscriptionResponse;
use OpenAI\Responses\Audio\TranslationResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

final class Audio extends Resource implements AudioContract
{
    /**
     * Generates audio from the input text.
     *
     * @see https://platform.openai.com/docs/api-reference/audio/createSpeech
     *
     * @param  array<string, mixed>  $parameters
     */
    public function speech(array $parameters): string
    {
        $payload = Payload::create('audio/speech', $parameters);

        $response = $this->transporter->requestContent($payload);

        $this->event(new RequestHandled($payload, $response));

        return $response;
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

        $responseRaw = $this->transporter->requestStream($payload);

        $response = new SpeechStreamResponse($responseRaw);

        $this->event(new RequestHandled($payload, $response));

        return $response;
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
        $payload = Payload::upload('audio/transcriptions', $parameters);

        /** @var Response<array{task: ?string, language: ?string, duration: ?float, segments: array<int, array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient?: bool}>, text: string}> $responseRaw */
        $responseRaw = $this->transporter->requestObject($payload);

        $response = TranscriptionResponse::from($responseRaw->data(), $responseRaw->meta());

        $this->event(new RequestHandled($payload, $response));

        return $response;
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

        /** @var Response<array{task: ?string, language: ?string, duration: ?float, segments: array<int, array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient?: bool}>, text: string}> $responseRaw */
        $responseRaw = $this->transporter->requestObject($payload);

        $response = TranslationResponse::from($responseRaw->data(), $responseRaw->meta());

        $this->event(new RequestHandled($payload, $response));

        return $response;
    }
}
