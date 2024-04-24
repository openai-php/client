<?php

namespace OpenAI\Responses\Threads\Runs;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Meta\MetaInformation;
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

    /**
     * @param  array<int, ThreadRunResponse>  $data
     */
    private function __construct(
        public readonly string $event,
        public readonly ThreadResponse|ThreadRunResponse|ThreadRunStepResponse|ThreadRunStepDeltaResponse|ThreadMessageResponse|ThreadMessageDeltaResponse $response,
        private readonly MetaInformation $meta,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     *  Maps the appropriate classes onto each event from the assistants streaming api
     *  https://platform.openai.com/docs/api-reference/assistants-streaming/events
     *
     * @param  array<string, mixed>  $attributes
     */
    public static function from(array $data): self
    {
        $event = $data['__event'];
        unset($data['__event']);

        $meta = $data['__meta'];
        unset($data['__meta']);

        $response = match ($event) {
            'thread.created' => ThreadResponse::from($data, $meta),
            'thread.run.created',
            'thread.run.queued',
            'thread.run.in_progress',
            'thread.run.requires_action',
            'thread.run.completed',
            'thread.run.failed',
            'thread.run.cancelling',
            'thread.run.cancelled',
            'thread.run.expired' => ThreadRunResponse::from($data, $meta),
            'thread.run.step.created',
            'thread.run.step.in_progress',
            'thread.run.step.completed',
            'thread.run.step.failed',
            'thread.run.step.cancelled',
            'thread.run.step.expired' => ThreadRunStepResponse::from($data, $meta),
            'thread.run.step.delta' => ThreadRunStepDeltaResponse::from($data),
            'thread.message.created',
            'thread.message.in_progress',
            'thread.message.completed',
            'thread.message.incomplete' => ThreadMessageResponse::from($data, $meta),
            'thread.message.delta' => ThreadMessageDeltaResponse::from($data),
            default => throw new ErrorException('Unhandled event type: '.$event),
        };

        return new self(
            $event,
            $response,
            $meta,
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
