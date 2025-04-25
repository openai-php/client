<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Exceptions\UnknownEventException;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Responses\Streaming\ContentPart;
use OpenAI\Responses\Responses\Streaming\OutputItem;
use OpenAI\Responses\Responses\Streaming\OutputTextAnnotationAdded;
use OpenAI\Responses\Responses\Streaming\OutputTextDelta;
use OpenAI\Testing\Responses\Concerns\FakeableForStreamedResponse;

/**
 * @phpstan-type CreateStreamedResponseType array{event: string, data: array<string, mixed>}
 *
 * @implements ResponseContract<CreateStreamedResponseType>
 */
final class CreateStreamedResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<CreateStreamedResponseType>
     */
    use ArrayAccessible;

    use FakeableForStreamedResponse;

    private function __construct(
        public readonly string $event,
        public readonly CreateResponse|OutputItem|ContentPart|OutputTextDelta|OutputTextAnnotationAdded $response,
    ) {}

    /**
     * @param  array<string, mixed>  $attributes
     */
    public static function from(array $attributes): self
    {
        $event = $attributes['__event'];
        unset($attributes['__event']);

        $meta = $attributes['__meta'];
        unset($attributes['__meta']);

        $response = match ($event) {
            'response.created',
            'response.in_progress',
            'response.completed',
            'response.failed',
            'response.incomplete' => CreateResponse::from($attributes['response'], $meta), // @phpstan-ignore-line
            'response.output_item.added',
            'response.output_item.done' => OutputItem::from($attributes, $meta), // @phpstan-ignore-line
            'response.content_part.added',
            'response.content_part.done' => ContentPart::from($attributes, $meta), // @phpstan-ignore-line
            'response.output_text.delta' => OutputTextDelta::from($attributes, $meta), // @phpstan-ignore-line
            'response.output_text.annotation.added' => OutputTextAnnotationAdded::from($attributes, $meta), // @phpstan-ignore-line

            'response.output_text.done',
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
