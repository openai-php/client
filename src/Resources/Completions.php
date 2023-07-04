<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\CompletionsContract;
use OpenAI\Responses\Completions\CreateResponse;
use OpenAI\Responses\Completions\CreateStreamedResponse;
use OpenAI\Responses\StreamResponse;
use OpenAI\ValueObjects\Transporter\Payload;

final class Completions implements CompletionsContract
{
    use Concerns\Transportable;
    use Concerns\Streamable;

    /**
     * Creates a completion for the provided prompt and parameters
     *
     * @see https://platorm.openai.com/docs/api-reference/completions/create-completion
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): CreateResponse
    {
        $this->ensureNotStreamed($parameters);

        $payload = Payload::create('completions', $parameters);

        /** @var array{id: string, object: string, created: int, model: string, choices: array<int, array{text: string, index: int, logprobs: array{tokens: array<int, string>, token_logprobs: array<int, float>, top_logprobs: array<int, string>|null, text_offset: array<int, int>}|null, finish_reason: string}>, usage: array{prompt_tokens: int, completion_tokens: int, total_tokens: int}} $result */
        $result = $this->transporter->requestObject($payload);

        return CreateResponse::from($result);
    }

    /**
     * Creates a streamed completion for the provided prompt and parameters
     *
     * @see https://platorm.openai.com/docs/api-reference/completions/create-completion
     *
     * @param  array<string, mixed>  $parameters
     * @return StreamResponse<CreateStreamedResponse>
     */
    public function createStreamed(array $parameters): StreamResponse
    {
        $parameters = $this->setStreamParameter($parameters);

        $payload = Payload::create('completions', $parameters);

        $response = $this->transporter->requestStream($payload);

        return new StreamResponse(CreateStreamedResponse::class, $response);
    }
}
