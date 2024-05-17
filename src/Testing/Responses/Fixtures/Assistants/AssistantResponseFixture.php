<?php

namespace OpenAI\Testing\Responses\Fixtures\Assistants;

final class AssistantResponseFixture
{
    public const ATTRIBUTES = [
        'id' => 'asst_SMzoVX8XmCZEg1EbMHoAm8tc',
        'object' => 'assistant',
        'created_at' => 1_699_619_403,
        'name' => 'Math Tutor',
        'description' => null,
        'model' => 'gpt-4',
        'instructions' => 'You are a personal math tutor.',
        'tools' => [],
        'tool_resources' => [],
        'metadata' => [],
        'temperature' => 0.7,
        'top_p' => 1.0,
        'response_format' => 'text',
    ];
}
