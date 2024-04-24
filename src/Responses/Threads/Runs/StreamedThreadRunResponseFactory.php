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
    public static function from($event, $data, $meta)
    {
        switch ($event) {
            case 'thread.created':
                return ThreadResponse::from($data, $meta);
            case 'thread.run.created':
            case 'thread.run.queued':
            case 'thread.run.in_progress':
            case 'thread.run.requires_action':
            case 'thread.run.completed':
            case 'thread.run.failed':
            case 'thread.run.cancelling':
            case 'thread.run.cancelled':
            case 'thread.run.expired':
                return ThreadRunResponse::from($data, $meta);
            case 'thread.run.step.created':
            case 'thread.run.step.in_progress':
            case 'thread.run.step.completed':
            case 'thread.run.step.failed':
            case 'thread.run.step.cancelled':
            case 'thread.run.step.expired':
                return ThreadRunStepResponse::from($data, $meta);
            case 'thread.run.step.delta':
                return ThreadRunStepDeltaResponse::from($data);
            case 'thread.message.created':
            case 'thread.message.in_progress':
            case 'thread.message.completed':
            case 'thread.message.incomplete':
                return ThreadMessageResponse::from($data, $meta);
            case 'thread.message.delta':
                return ThreadMessageDeltaResponse::from($data);
            default:
                throw new ErrorException('Unhandled event type: '.$event);
        }
    }
}
