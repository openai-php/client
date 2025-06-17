<?php

namespace OpenAI\Contracts\Resources;

use OpenAI\Responses\Audio\SpeechStreamResponse;
use OpenAI\Responses\Audio\TranscriptionResponse;
use OpenAI\Responses\Audio\TranscriptionStreamResponse;
use OpenAI\Responses\Audio\TranslationResponse;
use OpenAI\Responses\StreamResponse;

interface AudioContract
{
    /**
     * Generates audio from the input text.
     *
     * @see https://platform.openai.com/docs/api-reference/audio/createSpeech
     *
     * @param  array<string, mixed>  $parameters
     */
    public function speech(array $parameters): string;

    /**
     * Generates streamed audio from the input text.
     *
     * @see https://platform.openai.com/docs/api-reference/audio/createSpeech
     *
     * @param  array<string, mixed>  $parameters
     */
    public function speechStreamed(array $parameters): SpeechStreamResponse;

    /**
     * Transcribes audio into the input language.
     *
     * @see https://platform.openai.com/docs/api-reference/audio/createTranscription
     *
     * @param  array<string, mixed>  $parameters
     */
    public function transcribe(array $parameters): TranscriptionResponse;

    /**
     * Transcribes audio input the streamed events.
     *
     * @see https://platform.openai.com/docs/api-reference/audio/createTranscription#audio-createtranscription-stream
     *
     * @param  array<string, mixed>  $parameters
     * @return StreamResponse<TranscriptionStreamResponse>
     */
    public function transcribeStreamed(array $parameters): StreamResponse;

    /**
     * Translates audio into English.
     *
     * @see https://platform.openai.com/docs/api-reference/audio/createTranslation
     *
     * @param  array<string, mixed>  $parameters
     */
    public function translate(array $parameters): TranslationResponse;
}
