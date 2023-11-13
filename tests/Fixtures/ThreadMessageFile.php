<?php

/**
 * @return array<string, mixed>
 */
function threadMessageFileResource(): array
{
    return [
        'id' => 'file-DhxjnFCaSHc4ZELRGKwTMFtI',
        'object' => 'thread.message.file',
        'created_at' => 1699624660,
        'message_id' => 'msg_KNsDDwE41BUAHhcPNpDkdHWZ',
    ];
}

/**
 * @return array<string, mixed>
 */
function threadMessageFileListResource(): array
{
    return [
        'object' => 'list',
        'data' => [
            threadMessageFileResource(),
            threadMessageFileResource(),
        ],
        'first_id' => 'file-DhxjnFCaSHc4ZELRGKwTMFtI',
        'last_id' => 'file-DhxjnFCaSHc4ZELRGKwTMFtI',
        'has_more' => false,
    ];
}
