<?php

namespace OpenAI\Testing\Resources;

use OpenAI\Contracts\Resources\DecisionsContract;
use OpenAI\Resources\Decisions;
use OpenAI\Responses\Decisions\CreateResponse;
use OpenAI\Testing\Resources\Concerns\Testable;

final class DecisionsTestResource implements DecisionsContract
{
    use Testable;

    protected function resource(): string
    {
        return Decisions::class;
    }

    public function create(array $parameters): CreateResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }
}
