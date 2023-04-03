<?php

namespace OpenAI\Testing\Resources;

use OpenAI\Contracts\Resources\ModelsContract;
use OpenAI\Resources\Models;
use OpenAI\Responses\Models\DeleteResponse;
use OpenAI\Responses\Models\ListResponse;
use OpenAI\Responses\Models\RetrieveResponse;
use OpenAI\Testing\Resources\Concerns\Testable;

final class ModelsTestResource implements ModelsContract
{
    use Testable;

    protected function resource(): string
    {
        return Models::class;
    }

    public function list(): ListResponse
    {
        return $this->record(__FUNCTION__);
    }

    public function retrieve(string $model): RetrieveResponse
    {
        return $this->record(__FUNCTION__, $model);
    }

    public function delete(string $model): DeleteResponse
    {
        return $this->record(__FUNCTION__, $model);
    }
}
