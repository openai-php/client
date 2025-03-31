<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Exceptions\UnknownEventException;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Responses\CreateResponse;
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
        public readonly CreateResponse $response,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance. 
     *
     *  Maps the appropriate classes onto each event from the responses streaming api
     *  https://platform.openai.com/docs/guides/streaming-responses?api-mode=responses
     *
     * @param  array<string, mixed>  $attributes
     */
    public static function from(array $attributes): self
    {
        $event = $attributes['__event'];
        unset($attributes['__event']);

        $meta = $attributes['__meta'];
        unset($attributes['__meta']);

        $response = match ($event) {
            'response.created' => CreateResponse::from($attributes, $meta), // @phpstan-ignore-line
            'response.in_progress' => CreateResponse::from($attributes, $meta), // @phpstan-ignore-line
            'response.completed' => CreateResponse::from($attributes, $meta), // @phpstan-ignore-line
            'response.failed' => CreateResponse::from($attributes, $meta), // @phpstan-ignore-line
            'response.incomplete' => CreateResponse::from($attributes, $meta), // @phpstan-ignore-line
            'response.output_item.added' => CreateResponse::from($attributes, $meta), // @phpstan-ignore-line
            'response.output_item.done' => CreateResponse::from($attributes, $meta), // @phpstan-ignore-line
            'response.content_part.added' => CreateResponse::from($attributes, $meta), // @phpstan-ignore-line
            'response.content_part.done' => CreateResponse::from($attributes, $meta), // @phpstan-ignore-line
            'response.output_text.delta' => CreateResponse::from($attributes, $meta), // @phpstan-ignore-line
            'response.output_text.annotation.added' => CreateResponse::from($attributes, $meta), // @phpstan-ignore-line
            'response.output_text.done' => CreateResponse::from($attributes, $meta), // @phpstan-ignore-line
            'response.refusal.delta' => CreateResponse::from($attributes, $meta), // @phpstan-ignore-line
            'response.refusal.done' => CreateResponse::from($attributes, $meta), // @phpstan-ignore-line
            'response.function_call_arguments.delta' => CreateResponse::from($attributes, $meta), // @phpstan-ignore-line
            'response.function_call_arguments.done' => CreateResponse::from($attributes, $meta), // @phpstan-ignore-line
            'response.file_search_call.in_progress' => CreateResponse::from($attributes, $meta), // @phpstan-ignore-line
            'response.file_search_call.searching' => CreateResponse::from($attributes, $meta), // @phpstan-ignore-line
            'response.file_search_call.completed' => CreateResponse::from($attributes, $meta), // @phpstan-ignore-line
            'response.web_search_call.in_progress' => CreateResponse::from($attributes, $meta), // @phpstan-ignore-line
            'response.web_search_call.searching' => CreateResponse::from($attributes, $meta), // @phpstan-ignore-line
            'response.web_search_call.completed' => CreateResponse::from($attributes, $meta), // @phpstan-ignore-line
            default => throw new UnknownEventException('Unknown event: '.$event),
        };

        return new self(
            $event, // @phpstan-ignore-line
            $response,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'event' => $this->event,
            'data' => $this->response->toArray(),
        ];
    }

}