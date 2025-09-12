<?php

declare(strict_types=1);

namespace OpenAI\Contracts\Resources;

use OpenAI\Responses\Conversations\ConversationItem;
use OpenAI\Responses\Conversations\ConversationItemList;
use OpenAI\Responses\Conversations\ConversationResponse;

interface ConversationsItemsContract
{
    /**
     * Create items for a conversation
     *
     * @see https://platform.openai.com/docs/api-reference/conversations/create-item
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(string $conversationId, array $parameters): ConversationItemList;

    /**
     * List items for a conversation
     *
     * @see https://platform.openai.com/docs/api-reference/conversations/list-items
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(string $conversationId, array $parameters = []): ConversationItemList;

    /**
     * Retrieve a specific item from a conversation
     *
     * @see https://platform.openai.com/docs/api-reference/conversations/get-item
     *
     * @param  array<string, mixed>  $parameters
     */
    public function retrieve(string $conversationId, string $itemId, array $parameters = []): ConversationItem;

    /**
     * Delete a specific item from a conversation. Returns updated Conversation.
     *
     * @see https://platform.openai.com/docs/api-reference/conversations/delete-item
     */
    public function delete(string $conversationId, string $itemId): ConversationResponse;
}
