<?php

namespace OpenAI\Testing\Resources;

use OpenAI\Contracts\Resources\ContainersContract;
use OpenAI\Resources\Containers;
use OpenAI\Responses\Containers\DeleteContainer;
use OpenAI\Responses\Containers\RetrieveContainer;
use OpenAI\Responses\Responses\CreateResponse;
use OpenAI\Responses\Responses\ListInputItems;
use OpenAI\Testing\Resources\Concerns\Testable;

final class ContainersTestResource implements ContainersContract
{
    use Testable;

    public function resource(): string
    {
        return Containers::class;
    }

    public function create(array $parameters): CreateResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function retrieve(string $id): RetrieveContainer
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function list(string $id, array $parameters = []): ListInputItems
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function delete(string $id): DeleteContainer
    {
        return $this->record(__FUNCTION__, func_get_args());
    }
}
