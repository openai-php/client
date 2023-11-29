<?php

namespace OpenAI\Testing\Resources;

use OpenAI\Contracts\Resources\EmbeddingsContract;
use OpenAI\Resources\Embeddings;
use OpenAI\Responses\Embeddings\CreateResponse;
use OpenAI\Testing\Resources\Concerns\Testable;

final class EmbeddingsTestResource implements EmbeddingsContract
{
    use Testable;

    protected function resource(): string
    {
        return Embeddings::class;
    }

    public function create(array $parameters): CreateResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }
}
