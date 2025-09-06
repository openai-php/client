<?php

declare(strict_types=1);

namespace OpenAI\Contracts\Resources;

use OpenAI\Responses\Conversations\ConversationDeletedResponse;
use OpenAI\Responses\Conversations\ConversationResponse;

interface ConversationsContract
{
    /**
     * Create a conversation
     *
     * @see https://platform.openai.com/docs/api-reference/conversations/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters = []): ConversationResponse;

    /**
     * Retrieve a conversation by ID
     *
     * @see https://platform.openai.com/docs/api-reference/conversations/retrieve
     */
    public function retrieve(string $conversationId): ConversationResponse;

    /**
     * Update a conversation by ID
     *
     * @see https://platform.openai.com/docs/api-reference/conversations/update
     *
     * @param  array<string, mixed>  $parameters
     */
    public function update(string $conversationId, array $parameters): ConversationResponse;

    /**
     * Delete a conversation by ID
     *
     * @see https://platform.openai.com/docs/api-reference/conversations/delete
     */
    public function delete(string $conversationId): ConversationDeletedResponse;

    /**
     * Manage conversation items subresource.
     *
     * @see https://platform.openai.com/docs/api-reference/conversations/list-items
     */
    public function items(): ConversationsItemsContract;
}
