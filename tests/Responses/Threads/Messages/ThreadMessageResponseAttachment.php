<?php

use OpenAI\Responses\Threads\Messages\ThreadMessageResponseAttachment;
use OpenAI\Responses\Threads\Messages\ThreadMessageResponseAttachmentFileSearchTool;

test('from', function () {
    $result = ThreadMessageResponseAttachment::from(threadMessageResource()['attachments'][0]);

    expect($result)
        ->fileId->toEqual('file-DhxjnFCaSHc4ZELRGKwTMFtI')
        ->tools->toBeArray()
        ->tools->{0}->toBeInstanceOf(ThreadMessageResponseAttachmentFileSearchTool::class)
        ->tools->{0}->type->toBe('file_search');

});

test('as array accessible', function () {
    $result = ThreadMessageResponseAttachment::from(threadMessageResource()['attachments'][0]);

    expect($result['file_id'])
        ->toBe('file-DhxjnFCaSHc4ZELRGKwTMFtI');
});

test('to array', function () {
    $result = ThreadMessageResponseAttachment::from(threadMessageResource()['attachments'][0]);

    expect($result->toArray())
        ->toBe(threadMessageResource()['attachments'][0]);
});
