<?php

namespace OpenAI\Testing\Responses\Fixtures\Chat;

final class ListResponseFixture
{
    public const ATTRIBUTES = [
        'object' => 'list',
        'data' => [
            CreateResponseFixture::ATTRIBUTES,
        ],
        'first_id' => 'chatcmpl-123',
        'last_id' => 'chatcmpl-123',
        'has_more' => false,
    ];
}
