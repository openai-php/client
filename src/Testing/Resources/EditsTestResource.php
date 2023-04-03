<?php

namespace OpenAI\Testing\Resources;

use OpenAI\Contracts\Resources\EditsContract;
use OpenAI\Resources\Edits;
use OpenAI\Responses\Edits\CreateResponse;
use OpenAI\Testing\Resources\Concerns\Testable;

final class EditsTestResource implements EditsContract
{
    use Testable;

    protected function resource(): string
    {
        return Edits::class;
    }

    public function create(array $parameters): CreateResponse
    {
        return $this->record(__FUNCTION__, $parameters);
    }
}
