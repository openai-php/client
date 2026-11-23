<?php

declare(strict_types=1);

namespace OpenAI\Contracts\Resources;

use OpenAI\Responses\Responses\InputTokenCountResponse;

interface ResponsesInputTokensContract
{
    /**
     * Counts the input tokens of a request to the Responses API, without creating a response.
     *
     * @see https://developers.openai.com/api/docs/guides/token-counting
     *
     * @param  array<string, mixed>  $parameters
     */
    public function count(array $parameters): InputTokenCountResponse;
}
