<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use Http\Discovery\Exception\NotFoundException;
use OpenAI\Responses\Chat\CreateResponse;
use OpenAI\Responses\Chat\CreateStreamedResponse;
use OpenAI\Responses\StreamResponse;
use OpenAI\ValueObjects\Transporter\Payload;

final class Chat
{
    use Concerns\Transportable;
    use Concerns\Streamable;

    /**
     * Creates a completion for the chat message
     *
     * @see https://platform.openai.com/docs/api-reference/chat/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): CreateResponse
    {
        $this->ensureNotStreamed($parameters);

        $payload = Payload::create('chat/completions', $parameters);

        /** @var array{id: string, object: string, created: int, model: string, choices: array<int, array{index: int, message: array{role: string, content: string}, finish_reason: string|null}>, usage: array{prompt_tokens: int, completion_tokens: int|null, total_tokens: int}} $result */
        $result = $this->transporter->requestObject($payload);

        return CreateResponse::from($result);
    }

    /**
     * Creates a streamed completion for the chat message
     *
     * @see https://platform.openai.com/docs/api-reference/chat/create
     *
     * @param  array<string, mixed>  $parameters
     * @return StreamResponse<CreateStreamedResponse>
     */
    public function createStreamed(array $parameters): StreamResponse
    {
        $parameters = $this->setStreamParameter($parameters);

        $payload = Payload::create('chat/completions', $parameters);

        $response = $this->transporter->requestStream($payload);

        $streamResponse = new StreamResponse(CreateStreamedResponse::class, $response);

        $this->assertValidResponse($streamResponse, $parameters['model']);

        return $streamResponse;
    }

    /**
     * Asserts that the given StreamResponse is valid by checking its status code.
     * Throws a NotFoundException if the status code is 404.
     *
     * @param StreamResponse $streamResponse The StreamResponse to be validated
     * @param string         $model          The model name associated with the StreamResponse
     *
     * @throws NotFoundException If the StreamResponse's status code is 404
     */
    private function assertValidResponse(StreamResponse $streamResponse, string $model): void
    {
        if (404 === $streamResponse->getStatusCode()) {
            throw new NotFoundException(sprintf('Model "%s" not found', $model));
        }
    }
}
