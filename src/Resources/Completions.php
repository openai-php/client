<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Requests\Completions\CreateCompletionRequest;
use OpenAI\Responses\Completions\CreateResponse;
use OpenAI\ValueObjects\Transporter\Payload;

final class Completions
{
    use Concerns\Transportable;

    /**
     * Creates a completion for the provided prompt and parameters
     *
     * @see https://beta.openai.com/docs/api-reference/completions/create-completion
     *
     * @param  array<string, mixed>  $request
     */
    public function create(array|CreateCompletionRequest $request): CreateResponse
    {
        $request = is_array($request) ? CreateCompletionRequest::from($request) : $request;

        $payload = Payload::create('completions', $request->toArray());

        /** @var array{id: string, object: string, created: int, model: string, choices: array<int, array{text: string, index: int, logprobs: array{tokens: array<int, string>, token_logprobs: array<int, float>, top_logprobs: array<int, string>|null, text_offset: array<int, int>}|null, finish_reason: string}>, usage: array{prompt_tokens: int, completion_tokens: int, total_tokens: int}} $result */
        $result = $this->transporter->requestObject($payload);

        return CreateResponse::from($result);
    }
}
