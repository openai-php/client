<?php

namespace OpenAI\Testing\Responses\Fixtures\Responses;

final class ListInputItemsFixture
{
    public const ATTRIBUTES = [
        'object' => 'list',
        'data' => [
            [
                'type' => 'message',
                'id' => 'resp_item_67ccd2bed1ec8190b14f964abc0542670bb6a6b452d3795b',
                'status' => 'completed',
                'role' => 'user',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Tell me a story about a unicorn',
                        'annotations' => []
                    ]
                ]
            ]
        ],
        'first_id' => 'resp_item_67ccd2bed1ec8190b14f964abc0542670bb6a6b452d3795b',
        'last_id' => 'resp_item_67ccd2bed1ec8190b14f964abc0542670bb6a6b452d3795b',
        'has_more' => false
    ];
}