<?php

namespace OpenAI\Testing\Resources;

use OpenAI\Contracts\Resources\ThreadsRunsContract;
use OpenAI\Resources\ThreadsRuns;
use OpenAI\Responses\Threads\Runs\ThreadRunListResponse;
use OpenAI\Responses\Threads\Runs\ThreadRunResponse;
use OpenAI\Testing\Resources\Concerns\Testable;

final class ThreadsRunsTestResource implements ThreadsRunsContract
{
    use Testable;

    public function resource(): string
    {
        return ThreadsRuns::class;
    }

    public function create(string $threadId, array $parameters): ThreadRunResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function retrieve(string $threadId, string $runId): ThreadRunResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function modify(string $threadId, string $runId, array $parameters): ThreadRunResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function submitToolOutputs(string $threadId, string $runId, array $parameters): ThreadRunResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function cancel(string $threadId, string $runId): ThreadRunResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function list(string $threadId, array $parameters = []): ThreadRunListResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function steps(): ThreadsRunsStepsTestResource
    {
        return new ThreadsRunsStepsTestResource($this->fake);
    }
}
