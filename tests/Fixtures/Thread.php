<?php

/**
 * @return array<string, mixed>
 */
function threadResource(): array
{
    return [
        'id' => 'thread_agvtHUGezjTCt4SKgQg0NJ2Y',
        'object' => 'thread',
        'created_at' => 1699621778,
        'metadata' => [],
    ];
}

/**
 * @return array<string, mixed>
 */
function threadListResource(): array
{
    return [
        'object' => 'list',
        'data' => [
            threadResource(),
            threadResource(),
        ],
        'first_id' => 'thread_agvtHUGezjTCt4SKgQg0NJ2Y',
        'last_id' => 'thread_qVpWfffa654XBdU3tl2iUdVy',
        'has_more' => false,
    ];
}

/**
 * @return array<string, mixed>
 */
function threadDeleteResource(): array
{
    return [
        'id' => 'thread_agvtHUGezjTCt4SKgQg0NJ2Y',
        'object' => 'thread.deleted',
        'deleted' => true,
    ];
}
