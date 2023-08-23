<?php

namespace OpenAI\Contracts\Resources;

use OpenAI\Responses\Edits\CreateResponse;

interface EditsContract
{
    /**
     * Creates a new edit for the provided input, instruction, and parameters.
     *
     * @see https://platform.openai.com/docs/api-reference/edits/create
     *
     * @param  array<string, mixed>  $parameters
     *
     * @deprecated OpenAI has deprecated this endpoint and will stop working by January 4, 2024.
     * https://openai.com/blog/gpt-4-api-general-availability#deprecation-of-the-edits-api
     */
    public function create(array $parameters): CreateResponse;
}
