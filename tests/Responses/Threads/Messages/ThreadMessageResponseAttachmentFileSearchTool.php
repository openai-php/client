<?php

use OpenAI\Responses\Threads\Messages\ThreadMessageResponseAttachmentFileSearchTool;

test('from', function () {
    $result = ThreadMessageResponseAttachmentFileSearchTool::from(threadMessageResource()['attachments'][0]['tools'][0]);

    expect($result)
        ->type->toEqual('file_search');
});

test('as array accessible', function () {
    $result = ThreadMessageResponseAttachmentFileSearchTool::from(threadMessageResource()['attachments'][0]['tools'][0]);

    expect($result['type'])
        ->toBe('file_search');
});

test('to array', function () {
    $result = ThreadMessageResponseAttachmentFileSearchTool::from(threadMessageResource()['attachments'][0]['tools'][0]);

    expect($result->toArray())
        ->toBe(threadMessageResource()['attachments'][0]['tools'][0]);
});
