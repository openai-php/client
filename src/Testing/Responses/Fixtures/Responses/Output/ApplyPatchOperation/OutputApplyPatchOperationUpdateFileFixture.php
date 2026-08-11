<?php

namespace OpenAI\Testing\Responses\Fixtures\Responses\Output\ApplyPatchOperation;

final class OutputApplyPatchOperationUpdateFileFixture
{
    public const ATTRIBUTES = [
        'type' => 'update_file',
        'diff' => "@@\n-old line\n+new line",
        'path' => 'src/Example.php',
    ];
}
