<?php

declare(strict_types=1);

namespace OpenAI\Contracts\Resources;

use OpenAI\Responses\Decisions\CreateResponse;

interface DecisionsContract
{
    /**
     * Evaluates text, images, or both against a list of questions.
     *
     * @see https://developers.openai.com/api/docs/guides/decisions
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): CreateResponse;
}
