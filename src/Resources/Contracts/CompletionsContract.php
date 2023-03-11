<?php

namespace OpenAI\Resources\Contracts;

use OpenAI\Responses\Completions\CreateResponse;

interface CompletionsContract
{
    /**
     * Creates a completion for the provided prompt and parameters
     *
     * @see https://beta.openai.com/docs/api-reference/completions/create-completion
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): CreateResponse;
}
