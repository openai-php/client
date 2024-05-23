<?php

namespace OpenAI\Testing\Responses\Fixtures\Assistants;

final class AssistantListResponseFixture
{
    public const ATTRIBUTES = [
        'object' => 'list',
        'data' => [
            [
                'id' => 'asst_abc123',
                'object' => 'assistant',
                'created_at' => 1698982736,
                'name' => 'Coding Tutor',
                'description' => null,
                'model' => 'gpt-4-turbo',
                'instructions' => 'You are a helpful assistant designed to make me better at coding!',
                'tools' => [],
                'tool_resources' => [],
                'metadata' => [],
                'top_p' => 1.0,
                'temperature' => 1.0,
                'response_format' => 'auto'
            ],
        ],
        'first_id' => 'asst_SMzoVX8XmCZEg1EbMHoAm8tc',
        'last_id' => 'asst_SMzoVX8XmCZEg1EbMHoAm8tc',
        'has_more' => false,
    ];
}
