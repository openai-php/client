<?php

namespace OpenAI\Responses\Threads\Runs;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Exceptions\UnknownEventException;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Threads\Messages\Delta\ThreadMessageDeltaResponse;
use OpenAI\Responses\Threads\Messages\ThreadMessageResponse;
use OpenAI\Responses\Threads\Runs\Steps\Delta\ThreadRunStepDeltaResponse;
use OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepResponse;
use OpenAI\Responses\Threads\ThreadResponse;

/**
 * @implements ResponseContract<array{event: string, data: array<string, mixed>}>
 */
class ThreadRunStreamResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{event: string, data: array<string, mixed>}>
     */
    use ArrayAccessible;

    private function __construct(
        public readonly string $event,
        public readonly ThreadResponse|ThreadRunResponse|ThreadRunStepResponse|ThreadRunStepDeltaResponse|ThreadMessageResponse|ThreadMessageDeltaResponse $response,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     *  Maps the appropriate classes onto each event from the assistants streaming api
     *  https://platform.openai.com/docs/api-reference/assistants-streaming/events
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
            'thread.created' => ThreadResponse::from($attributes, $meta), // @phpstan-ignore-line
            'thread.run.created',
            'thread.run.queued',
            'thread.run.in_progress',
            'thread.run.requires_action',
            'thread.run.completed',
            'thread.run.incomplete',
            'thread.run.failed',
            'thread.run.cancelling',
            'thread.run.cancelled',
            'thread.run.expired' => ThreadRunResponse::from($attributes, $meta), // @phpstan-ignore-line
            'thread.run.step.created',
            'thread.run.step.in_progress',
            'thread.run.step.completed',
            'thread.run.step.failed',
            'thread.run.step.cancelled',
            'thread.run.step.expired' => ThreadRunStepResponse::from($attributes, $meta), // @phpstan-ignore-line
            'thread.run.step.delta' => ThreadRunStepDeltaResponse::from($attributes), // @phpstan-ignore-line
            'thread.message.created',
            'thread.message.in_progress',
            'thread.message.completed',
            'thread.message.incomplete' => ThreadMessageResponse::from($attributes, $meta), // @phpstan-ignore-line
            'thread.message.delta' => ThreadMessageDeltaResponse::from($attributes), // @phpstan-ignore-line
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
