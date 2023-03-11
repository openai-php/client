<?php

namespace OpenAI\Testing\Resources;

use OpenAI\Resources\Completions;
use OpenAI\Resources\Contracts\CompletionsContract;
use OpenAI\Responses\Completions\CreateResponse;
use OpenAI\Testing\Resources\Concerns\Testable;

final class CompletionsTestResource implements CompletionsContract
{
    use Testable;

    protected function resource(): string
    {
        return Completions::class;
    }

    public function create(array $parameters): CreateResponse
    {
        return $this->record(__FUNCTION__, $parameters);
    }
}
