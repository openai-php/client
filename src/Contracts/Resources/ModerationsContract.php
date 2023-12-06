<?php

namespace OpenAI\Contracts\Resources;

use OpenAI\Exceptions\OpenAIThrowable;
use OpenAI\Responses\Moderations\CreateResponse;

interface ModerationsContract
{
    /**
     * Classifies if text violates OpenAI's Content Policy.
     *
     * @see https://platform.openai.com/docs/api-reference/moderations/create
     *
     * @param  array<string, mixed>  $parameters
     *
     * @throws OpenAIThrowable
     */
    public function create(array $parameters): CreateResponse;
}
