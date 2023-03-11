<?php

namespace OpenAI\Resources\Contracts;

use OpenAI\Responses\Edits\CreateResponse;

interface EditsContract
{
    /**
     * Creates a new edit for the provided input, instruction, and parameters.
     *
     * @see https://beta.openai.com/docs/api-reference/edits/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): CreateResponse;
}
