<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\ResponsesInputTokensContract;
use OpenAI\Responses\Responses\InputTokenCountResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

/**
 * @phpstan-import-type InputTokenCountResponseType from InputTokenCountResponse
 */
final class ResponsesInputTokens implements ResponsesInputTokensContract
{
    use Concerns\Transportable;

    /**
     * Counts the input tokens of a request to the Responses API, without creating a response.
     *
     * @see https://developers.openai.com/api/docs/guides/token-counting
     *
     * @param  array<string, mixed>  $parameters
     */
    public function count(array $parameters): InputTokenCountResponse
    {
        $payload = Payload::create('responses/input_tokens', $parameters);

        /** @var Response<InputTokenCountResponseType> $response */
        $response = $this->transporter->requestObject($payload);

        return InputTokenCountResponse::from($response->data(), $response->meta());
    }
}
