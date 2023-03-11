<?php

namespace OpenAI\Testing\Resources;

use OpenAI\Resources\Chat;
use OpenAI\Resources\Contracts\ChatContract;
use OpenAI\Responses\Chat\CreateResponse;
use OpenAI\Testing\Resources\Concerns\Testable;

final class ChatTestResource implements ChatContract
{
    use Testable;

    protected function resource(): string
    {
        return Chat::class;
    }

    public function create(array $parameters): CreateResponse
    {
        return $this->record(__FUNCTION__, $parameters);
    }
}
