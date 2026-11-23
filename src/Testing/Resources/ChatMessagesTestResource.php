<?php

namespace OpenAI\Testing\Resources;

use OpenAI\Contracts\Resources\ChatMessagesContract;
use OpenAI\Resources\ChatMessages;
use OpenAI\Responses\Chat\ListMessagesResponse;
use OpenAI\Testing\Resources\Concerns\Testable;

final class ChatMessagesTestResource implements ChatMessagesContract
{
    use Testable;

    public function resource(): string
    {
        return ChatMessages::class;
    }

    public function list(string $completionId, array $parameters = []): ListMessagesResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }
}
