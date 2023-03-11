<?php

namespace OpenAI\Resources\Contracts;

use OpenAI\Responses\Embeddings\CreateResponse;

interface EmbeddingsContract
{
    /**
     * Creates an embedding vector representing the input text.
     *
     * @see https://beta.openai.com/docs/api-reference/embeddings/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): CreateResponse;
}
