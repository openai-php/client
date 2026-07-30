<?php

use OpenAI\Responses\Responses\Output\ApplyPatchOperation\OutputApplyPatchOperationCreateFile;
use OpenAI\Responses\Responses\Output\ApplyPatchOperation\OutputApplyPatchOperationDeleteFile;
use OpenAI\Responses\Responses\Output\ApplyPatchOperation\OutputApplyPatchOperationUpdateFile;
use OpenAI\Responses\Responses\Output\OutputApplyPatchToolCall;

test('from', function () {
    $response = OutputApplyPatchToolCall::from(outputApplyPatchToolCall());

    expect($response)
        ->toBeInstanceOf(OutputApplyPatchToolCall::class)
        ->id->toBe('apc_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->callId->toBe('call_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c')
        ->operation->toBeInstanceOf(OutputApplyPatchOperationUpdateFile::class)
        ->operation->diff->toBe("@@\n-old line\n+new line")
        ->operation->path->toBe('src/Example.php')
        ->status->toBe('completed')
        ->type->toBe('apply_patch_call')
        ->caller->toBe(['type' => 'direct'])
        ->createdBy->toBe('user_123');
});

test('parses every operation type', function (array $operation, string $expectedClass) {
    $attributes = outputApplyPatchToolCall();
    $attributes['operation'] = $operation;

    $response = OutputApplyPatchToolCall::from($attributes);

    expect($response->operation)
        ->toBeInstanceOf($expectedClass)
        ->and($response->toArray())
        ->toBe($attributes);
})->with([
    'create file' => [
        [
            'type' => 'create_file',
            'diff' => "@@\n+new file",
            'path' => 'src/New.php',
        ],
        OutputApplyPatchOperationCreateFile::class,
    ],
    'delete file' => [
        [
            'type' => 'delete_file',
            'path' => 'src/Old.php',
        ],
        OutputApplyPatchOperationDeleteFile::class,
    ],
    'update file' => [
        [
            'type' => 'update_file',
            'diff' => "@@\n-old\n+new",
            'path' => 'src/Existing.php',
        ],
        OutputApplyPatchOperationUpdateFile::class,
    ],
]);

test('as array accessible', function () {
    $response = OutputApplyPatchToolCall::from(outputApplyPatchToolCall());

    expect($response['type'])->toBe('apply_patch_call');
});

test('to array', function () {
    $response = OutputApplyPatchToolCall::from(outputApplyPatchToolCall());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(outputApplyPatchToolCall());
});
