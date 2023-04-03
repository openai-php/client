<?php

namespace OpenAI\Testing\Resources;

use OpenAI\Contracts\Resources\AudioContract;
use OpenAI\Resources\Audio;
use OpenAI\Responses\Audio\TranscriptionResponse;
use OpenAI\Responses\Audio\TranslationResponse;
use OpenAI\Testing\Resources\Concerns\Testable;

final class AudioTestResource implements AudioContract
{
    use Testable;

    protected function resource(): string
    {
        return Audio::class;
    }

    public function transcribe(array $parameters): TranscriptionResponse
    {
        return $this->record(__FUNCTION__, $parameters);
    }

    public function translate(array $parameters): TranslationResponse
    {
        return $this->record(__FUNCTION__, $parameters);
    }
}
