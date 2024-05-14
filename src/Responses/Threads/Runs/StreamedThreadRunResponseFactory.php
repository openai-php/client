<?php

namespace OpenAI\Responses\Threads\Runs;

use OpenAI\Responses\Threads\Messages\Delta\ThreadMessageDeltaResponse;
use OpenAI\Responses\Threads\Messages\ThreadMessageResponse;
use OpenAI\Responses\Threads\Runs\Steps\Delta\ThreadRunStepDeltaResponse;
use OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepResponse;
use OpenAI\Responses\Threads\ThreadResponse;

class StreamedThreadRunResponseFactory
{
    /**
     * Maps the appropriate classes onto each event from the assistants streaming api
     * https://platform.openai.com/docs/api-reference/assistants-streaming/events
     */
    public static function from($event, array $data, \OpenAI\Responses\Meta\MetaInformation $meta)
    {
        return match ($event) {
            'thread.created' => ThreadResponse::from($data, $meta),
            'thread.run.created', 'thread.run.queued', 'thread.run.in_progress', 'thread.run.requires_action', 'thread.run.completed', 'thread.run.failed', 'thread.run.cancelling', 'thread.run.cancelled', 'thread.run.expired' => ThreadRunResponse::from($data, $meta),
            'thread.run.step.created', 'thread.run.step.in_progress', 'thread.run.step.completed', 'thread.run.step.failed', 'thread.run.step.cancelled', 'thread.run.step.expired' => ThreadRunStepResponse::from($data, $meta),
            'thread.run.step.delta' => ThreadRunStepDeltaResponse::from($data),
            'thread.message.created', 'thread.message.in_progress', 'thread.message.completed', 'thread.message.incomplete' => ThreadMessageResponse::from($data, $meta),
            'thread.message.delta' => ThreadMessageDeltaResponse::from($data),
            default => throw new ErrorException('Unhandled event type: '.$event),
        };
    }
}
