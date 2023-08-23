<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\EditsContract;
use OpenAI\Responses\Edits\CreateResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

final class Edits implements EditsContract
{
    use Concerns\Transportable;

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
    public function create(array $parameters): CreateResponse
    {
        $payload = Payload::create('edits', $parameters);

        /** @var Response<array{object: string, created: int, choices: array<int, array{text: string, index: int}>, usage: array{prompt_tokens: int, completion_tokens: int, total_tokens: int}}> $response */
        $response = $this->transporter->requestObject($payload);

        return CreateResponse::from($response->data(), $response->meta());
    }
}
