<?php

namespace OpenAI\Testing\Resources;

use OpenAI\Contracts\Resources\ConversationsContract;
use OpenAI\Contracts\Resources\ConversationsItemsContract;
use OpenAI\Resources\Conversations;
use OpenAI\Responses\Conversations\ConversationDeletedResponse;
use OpenAI\Responses\Conversations\ConversationResponse;
use OpenAI\Testing\Resources\Concerns\Testable;

final class ConversationsTestResource implements ConversationsContract
{
    use Testable;

    public function resource(): string
    {
        return Conversations::class;
    }

    public function create(array $parameters = []): ConversationResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function retrieve(string $conversationId): ConversationResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function update(string $conversationId, array $parameters): ConversationResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function delete(string $conversationId): ConversationDeletedResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function items(): ConversationsItemsContract
    {
        return new ConversationsItemsTestResource($this->fake);
    }
}
