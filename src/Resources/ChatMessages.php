<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\ChatMessagesContract;
use OpenAI\Responses\Chat\ListMessagesResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

/**
 * @phpstan-import-type ListMessagesResponseType from ListMessagesResponse
 */
final class ChatMessages implements ChatMessagesContract
{
    use Concerns\Transportable;

    /**
     * {@inheritdoc}
     */
    public function list(string $completionId, array $parameters = []): ListMessagesResponse
    {
        $payload = Payload::list("chat/completions/{$completionId}/messages", $parameters);

        /** @var Response<ListMessagesResponseType> $response */
        $response = $this->transporter->requestObject($payload);

        return ListMessagesResponse::from($response->data(), $response->meta());
    }
}
