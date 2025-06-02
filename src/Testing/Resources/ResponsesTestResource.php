<?php

namespace OpenAI\Testing\Resources;

use OpenAI\Contracts\Resources\ResponsesContract;
use OpenAI\Resources\Responses;
use OpenAI\Responses\Responses\CreateResponse;
use OpenAI\Responses\Responses\DeleteResponse;
use OpenAI\Responses\Responses\ListInputItems;
use OpenAI\Responses\Responses\RetrieveResponse;
use OpenAI\Responses\StreamResponse;
use OpenAI\Testing\Resources\Concerns\Testable;

final class ResponsesTestResource implements ResponsesContract
{
    use Testable;

    public function resource(): string
    {
        return Responses::class;
    }

    public function create(array $parameters): CreateResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function createStreamed(array $parameters): StreamResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function retrieve(string $id): RetrieveResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function list(string $id, array $parameters = []): ListInputItems
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function cancel(string $id): RetrieveResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function delete(string $id): DeleteResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }
}
