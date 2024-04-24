<?php

namespace OpenAI\Contracts\Resources;

use OpenAI\Responses\StreamResponse;
use OpenAI\Responses\Threads\Runs\ThreadRunListResponse;
use OpenAI\Responses\Threads\Runs\ThreadRunResponse;
use OpenAI\Responses\Threads\Runs\ThreadRunStreamResponse;

interface ThreadsRunsContract
{
    /**
     * Create a run.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/createRun
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(string $threadId, array $parameters): ThreadRunResponse;

    /**
     * Create a streamed run.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/createRun
     *
     * @param  array<string, mixed>  $parameters
     * @return StreamResponse<ThreadRunStreamResponse>
     */
    public function createStreamed(string $threadId, array $parameters): StreamResponse;

    /**
     * Retrieves a run.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/getRun
     */
    public function retrieve(string $threadId, string $runId): ThreadRunResponse;

    /**
     * Modifies a run.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/modifyRun
     *
     * @param  array<string, mixed>  $parameters
     */
    public function modify(string $threadId, string $runId, array $parameters): ThreadRunResponse;

    /**
     * This endpoint can be used to submit the outputs from the tool calls once they're all completed.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/submitToolOutputs
     *
     * @param  array<string, mixed>  $parameters
     */
    public function submitToolOutputs(string $threadId, string $runId, array $parameters): ThreadRunResponse;

    /**
     * This endpoint can be used to submit the outputs from the tool calls once they're all completed.
     * And stream back the response
     *
     * @see https://platform.openai.com/docs/api-reference/runs/submitToolOutputs
     *
     * @param  array<string, mixed>  $parameters
     * @return StreamResponse<ThreadRunStreamResponse>
     */
    public function submitToolOutputsStreamed(string $threadId, string $runId, array $parameters): StreamResponse;

    /**
     * Cancels a run that is `in_progress`.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/cancelRun
     */
    public function cancel(string $threadId, string $runId): ThreadRunResponse;

    /**
     * Returns a list of runs belonging to a thread.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/listRuns
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(string $threadId, array $parameters = []): ThreadRunListResponse;

    /**
     * Get steps attached to a run.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/step-object
     */
    public function steps(): ThreadsRunsStepsContract;
}
