<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\ListAssistantsResponse;
use OpenAI\Contracts\Resources\ThreadsMessagesContract;
use OpenAI\Contracts\Resources\ThreadsMessagesFilesContract;
use OpenAI\Contracts\Resources\ThreadsRunsContract;
use OpenAI\Contracts\Resources\ThreadsRunsStepsContract;
use OpenAI\Responses\Threads\Messages\ThreadMessageDeleteResponse;
use OpenAI\Responses\Threads\Messages\ThreadMessageListResponse;
use OpenAI\Responses\Threads\Messages\ThreadMessageResponse;
use OpenAI\Responses\Threads\Runs\ThreadRunListResponse;
use OpenAI\Responses\Threads\Runs\ThreadRunResponse;
use OpenAI\Responses\Threads\ThreadDeleteResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

final class ThreadsRuns implements ThreadsRunsContract
{
    use Concerns\Transportable;

    /**
     * Create a run.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/createRun
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(string $threadId, array $parameters): ThreadRunResponse
    {
        $payload = Payload::create('threads/'.$threadId.'/runs', $parameters);

        /** @var Response<array{created: int, data: array<int, array{url?: string, b64_json?: string}>}> $response */
        $response = $this->transporter->requestObject($payload);

        return ThreadRunResponse::from($response->data(), $response->meta());
    }

    /**
     * Retrieves a run.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/getRun
     */
    public function retrieve(string $threadId, string $runId): ThreadRunResponse
    {
        $payload = Payload::retrieve('threads/'.$threadId.'/runs', $runId);

        /** @var Response<array{created: int, data: array<int, array{url?: string, b64_json?: string}>}> $response */
        $response = $this->transporter->requestObject($payload);

        return ThreadRunResponse::from($response->data(), $response->meta());
    }

    /**
     * Modifies a run.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/modifyRun
     *
     * @param array<string, mixed> $parameters
     */
    public function modify(string $threadId, string $runId, array $parameters): ThreadRunResponse
    {
        $payload = Payload::modify('threads/'.$threadId.'/runs', $runId, $parameters);

        /** @var Response<array{created: int, data: array<int, array{url?: string, b64_json?: string}>}> $response */
        $response = $this->transporter->requestObject($payload);

        return ThreadRunResponse::from($response->data(), $response->meta());
    }

    /**
     * This endpoint can be used to submit the outputs from the tool calls once they're all completed.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/submitToolOutputs
     *
     * @param array<string, mixed> $parameters
     */
    public function submitToolOutputs(string $threadId, string $runId, array $parameters): ThreadRunResponse
    {
        $payload = Payload::create('threads/'.$threadId.'/runs/'.$runId.'/submit_tool_outputs', $parameters);

        /** @var Response<array{created: int, data: array<int, array{url?: string, b64_json?: string}>}> $response */
        $response = $this->transporter->requestObject($payload);

        return ThreadRunResponse::from($response->data(), $response->meta());
    }

    /**
     * Cancels a run that is `in_progress`.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/cancelRun
     *
     * @param array<string, mixed> $parameters
     */
    public function cancel(string $threadId, string $runId): ThreadRunResponse
    {
        $payload = Payload::cancel('threads/'.$threadId.'/runs', $runId);

        /** @var Response<array{created: int, data: array<int, array{url?: string, b64_json?: string}>}> $response */
        $response = $this->transporter->requestObject($payload);

        return ThreadRunResponse::from($response->data(), $response->meta());
    }

    /**
     * Returns a list of runs belonging to a thread.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/listRuns
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(string $threadId, array $parameters = []): ThreadRunListResponse
    {
        $payload = Payload::list('threads/'.$threadId.'/runs', $parameters);

        /** @var Response<array{created: int, data: array<int, array{url?: string, b64_json?: string}>}> $response */
        $response = $this->transporter->requestObject($payload);

        return ThreadRunListResponse::from($response->data(), $response->meta());
    }

    /**
     * Get steps attached to a run.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/step-object
     */
    public function steps(): ThreadsRunsStepsContract
    {
        return new ThreadsRunsSteps($this->transporter);
    }
}
