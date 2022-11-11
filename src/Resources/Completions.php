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
     * @param  CreateCompletionRequest|array{model: string, prompt?: null|string|array<int, string|int|array<int, int>>, suffix: ?string, max_tokens: ?int, temperature: ?float, top_p: ?float, n: ?int, stream: ?bool, logprobs: ?int, echo: ?bool, stop: null|string|array<int, string>, presence_penalty: ?float, frequency_penalty: ?float, best_of: ?int, logit_bias: null|string|array<string, float>, user: ?string}  $request
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
