<?php

namespace OpenAI\Testing\Resources;

use OpenAI\Contracts\Resources\ThreadsContract;
use OpenAI\Contracts\Resources\ThreadsMessagesContract;
use OpenAI\Contracts\Resources\ThreadsRunsContract;
use OpenAI\Resources\Threads;
use OpenAI\Responses\Threads\Runs\ThreadRunResponse;
use OpenAI\Responses\Threads\ThreadDeleteResponse;
use OpenAI\Responses\Threads\ThreadResponse;
use OpenAI\Testing\Resources\Concerns\Testable;

final class ThreadsTestResource implements ThreadsContract
{
    use Testable;

    public function resource(): string
    {
        return Threads::class;
    }

    public function create(array $parameters): ThreadResponse
    {
        return $this->record(__FUNCTION__, $parameters);
    }

    public function createAndRun(array $parameters): ThreadRunResponse
    {
        return $this->record(__FUNCTION__, $parameters);
    }

    public function retrieve(string $id): ThreadResponse
    {
        return $this->record(__FUNCTION__, $id);
    }

    public function modify(string $id, array $parameters): ThreadResponse
    {
        return $this->record(__FUNCTION__, $id, $parameters);
    }

    public function delete(string $id): ThreadDeleteResponse
    {
        return $this->record(__FUNCTION__, $id);
    }

    public function messages(): ThreadsMessagesContract
    {
        return new ThreadsMessagesTestResource($this->fake);
    }

    public function runs(): ThreadsRunsContract
    {
        return new ThreadsRunsTestResource($this->fake);
    }
}
