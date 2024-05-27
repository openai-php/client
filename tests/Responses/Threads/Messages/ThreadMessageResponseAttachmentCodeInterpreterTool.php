<?php

use OpenAI\Responses\Threads\Messages\ThreadMessageResponseAttachmentCodeInterpreterTool;

test('from', function () {
    $result = ThreadMessageResponseAttachmentCodeInterpreterTool::from(threadMessageResource()['attachments'][0]['tools'][1]);

    expect($result)
        ->type->toEqual('code_interpreter');
});

test('as array accessible', function () {
    $result = ThreadMessageResponseAttachmentCodeInterpreterTool::from(threadMessageResource()['attachments'][0]['tools'][1]);

    expect($result['type'])
        ->toBe('code_interpreter');
});

test('to array', function () {
    $result = ThreadMessageResponseAttachmentCodeInterpreterTool::from(threadMessageResource()['attachments'][0]['tools'][1]);

    expect($result->toArray())
        ->toBe(threadMessageResource()['attachments'][0]['tools'][1]);
});
