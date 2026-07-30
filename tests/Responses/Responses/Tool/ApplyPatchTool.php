<?php

use OpenAI\Responses\Responses\Tool\ApplyPatchTool;

test('from', function () {
    $response = ApplyPatchTool::from(toolApplyPatch());

    expect($response)
        ->toBeInstanceOf(ApplyPatchTool::class)
        ->type->toBe('apply_patch')
        ->allowedCallers->toBe([
            'direct',
            'programmatic',
        ]);
});

test('as array accessible', function () {
    $response = ApplyPatchTool::from(toolApplyPatch());

    expect($response['type'])->toBe('apply_patch');
});

test('to array', function () {
    $response = ApplyPatchTool::from(toolApplyPatch());

    expect($response->toArray())
        ->toBeArray()
        ->toBe(toolApplyPatch());
});
