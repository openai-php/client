<?php

declare(strict_types=1);

namespace OpenAI\Resources;

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
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): CreateResponse
    {
        $payload = Payload::create('completions', $parameters);

        $response = $this->transporter->requestObject($payload);

        if ($response->isStream()) {
            /** @var \Generator<integer, array{id: string, object: string, created: int, model: string, choices: array<int, array{text: string, index: int, logprobs: array{tokens: array<int, string>, token_logprobs: array<int, float>, top_logprobs: array<int, string>|null, text_offset: array<int, int>}|null, finish_reason: null}>, usage: null}> $stream */
            $stream = $response->stream();

            return CreateResponse::fromStream($stream);
        }

        /** @var array{id: string, object: string, created: int, model: string, choices: array<int, array{text: string, index: int, logprobs: array{tokens: array<int, string>, token_logprobs: array<int, float>, top_logprobs: array<int, string>|null, text_offset: array<int, int>}|null, finish_reason: string}>, usage: array{prompt_tokens: int, completion_tokens: int|null, total_tokens: int}} $object */
        $object = $response->object();

        return CreateResponse::from($object);
    }
}
