<?php

namespace OpenAI\Testing\Resources;

use OpenAI\Contracts\Resources\ResponsesInputTokensContract;
use OpenAI\Resources\ResponsesInputTokens;
use OpenAI\Responses\Responses\InputTokenCountResponse;
use OpenAI\Testing\Resources\Concerns\Testable;

final class ResponsesInputTokensTestResource implements ResponsesInputTokensContract
{
    use Testable;

    public function resource(): string
    {
        return ResponsesInputTokens::class;
    }

    public function count(array $parameters): InputTokenCountResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }
}
