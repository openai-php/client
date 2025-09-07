<?php

namespace OpenAI\Testing\Resources;

use OpenAI\Contracts\Resources\ConversationsItemsContract;
use OpenAI\Resources\ConversationsItems;
use OpenAI\Responses\Conversations\ConversationItem;
use OpenAI\Responses\Conversations\ConversationItemList;
use OpenAI\Responses\Conversations\ConversationResponse;
use OpenAI\Testing\Resources\Concerns\Testable;

final class ConversationsItemsTestResource implements ConversationsItemsContract
{
    use Testable;

    public function resource(): string
    {
        return ConversationsItems::class;
    }

    public function create(string $conversationId, array $parameters): ConversationItemList
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function list(string $conversationId, array $parameters = []): ConversationItemList
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function retrieve(string $conversationId, string $itemId, array $parameters = []): ConversationItem
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function delete(string $conversationId, string $itemId): ConversationResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }
}
