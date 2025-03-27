<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Exceptions\UnknownEventException;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\FakeableForStreamedResponse;

/**
 * @implements ResponseContract<array{event: string, data: array<string, mixed>}>
 */
final class CreateStreamedResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{event: string, data: array<string, mixed>}>
     */
    use ArrayAccessible;

    use FakeableForStreamedResponse;

    private function __construct(
        public readonly string $event,
        public readonly ?CreateResponse $response,
        public readonly array $data,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance. 
     *
     * Maps the appropriate classes onto each event from the responses streaming api
     * https://platform.openai.com/docs/guides/streaming-responses?api-mode=responses
     *
     * @param  array<string, mixed>  $attributes
     */
    public static function from(array $attributes): self
    {
        $event = $attributes['__event'] ?? null;
        unset($attributes['__event']);

        $meta = $attributes['__meta'] ?? null;
        unset($attributes['__meta']);

        // For events that return a full response object
        $response = null;
        if ($event === 'response.completed' && isset($meta)) {
            $response = CreateResponse::from($attributes, $meta);
        }

        return new self(
            $event ?? 'unknown',
            $response,
            $attributes,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'event' => $this->event,
            'data' => $this->response ? $this->response->toArray() : $this->data,
        ];
    }
}