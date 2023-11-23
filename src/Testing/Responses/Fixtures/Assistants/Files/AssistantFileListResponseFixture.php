<?php

namespace OpenAI\Testing\Responses\Fixtures\Assistants\Files;

final class AssistantFileListResponseFixture
{
    public const ATTRIBUTES = [
        'object' => 'list',
        'data' => [
            [
                'id' => 'file-6EsV79Y261TEmi0PY5iHbZdS',
                'object' => 'assistant.file',
                'created_at' => 1_699_620_898,
                'assistant_id' => 'asst_y49lAdZDiaQUxEBR6zrG846Q',
            ],
        ],
        'first_id' => 'file-6EsV79Y261TEmi0PY5iHbZdS',
        'last_id' => 'file-6EsV79Y261TEmi0PY5iHbZdS',
        'has_more' => false,
    ];
}
