<?php

namespace OpenAI\Testing\Responses\Fixtures\Conversations;

final class ConversationDeletedResponseFixture
{
    public const ATTRIBUTES = [
        'id' => 'conv_123',
        'object' => 'conversation.deleted',
        'deleted' => true,
    ];
}
