<?php

namespace OpenAI\Testing\Responses\Fixtures\Responses\Output\ApplyPatchOperation;

final class OutputApplyPatchOperationCreateFileFixture
{
    public const ATTRIBUTES = [
        'type' => 'create_file',
        'diff' => "@@\n+new file",
        'path' => 'src/New.php',
    ];
}
