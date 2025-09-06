<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\ConversationsContract;
use OpenAI\Contracts\Resources\ConversationsItemsContract;
use OpenAI\Responses\Conversations\ConversationDeletedResponse;
use OpenAI\Responses\Conversations\ConversationResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

/**
 * @phpstan-import-type ConversationType from ConversationResponse
 * @phpstan-import-type ConversationDeletedType from ConversationDeletedResponse
 */
final class Conversations implements ConversationsContract
{
    use Concerns\Transportable;

    /**
     * {@inheritdoc}
     */
    public function create(array $parameters = []): ConversationResponse
    {
        $payload = Payload::create('conversations', $parameters);

        /** @var Response<ConversationType> $response */
        $response = $this->transporter->requestObject($payload);

        return ConversationResponse::from($response->data(), $response->meta());
    }

    /**
     * {@inheritdoc}
     */
    public function retrieve(string $conversationId): ConversationResponse
    {
        $payload = Payload::retrieve('conversations', $conversationId);

        /** @var Response<ConversationType> $response */
        $response = $this->transporter->requestObject($payload);

        return ConversationResponse::from($response->data(), $response->meta());
    }

    /**
     * {@inheritdoc}
     */
    public function update(string $conversationId, array $parameters): ConversationResponse
    {
        $payload = Payload::modify('conversations', $conversationId, $parameters);

        /** @var Response<ConversationType> $response */
        $response = $this->transporter->requestObject($payload);

        return ConversationResponse::from($response->data(), $response->meta());
    }

    /**
     * {@inheritdoc}
     */
    public function delete(string $conversationId): ConversationDeletedResponse
    {
        $payload = Payload::delete('conversations', $conversationId);

        /** @var Response<ConversationDeletedType> $response */
        $response = $this->transporter->requestObject($payload);

        return ConversationDeletedResponse::from($response->data(), $response->meta());
    }

    /**
     * {@inheritdoc}
     */
    public function items(): ConversationsItemsContract
    {
        return new ConversationsItems($this->transporter);
    }
}
