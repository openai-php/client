<?php

declare(strict_types=1);

namespace OpenAI\Contracts\Resources;

use OpenAI\Responses\Chat\ListMessagesResponse;

interface ChatMessagesContract
{
    /**
     * Lists the messages of a stored chat completion
     *
     * @see https://developers.openai.com/api/reference/resources/chat/subresources/completions/subresources/messages/methods/list
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(string $completionId, array $parameters = []): ListMessagesResponse;
}
