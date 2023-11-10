<?php

/**
 * @return array<string, mixed>
 */
function threadRunResource(): array
{
    return [
        'id' => 'run_4RCYyYzX9m41WQicoJtUQAb8',
        'object' => 'thread.run',
        'created_at' => 1699621735,
        'assistant_id' => 'asst_EopvUEMh90bxkNRYEYM81Orc',
        'thread_id' => 'thread_EKt7MjGOC6bwKWmenQv5VD6r',
        'status' => 'queued',
        'started_at' => null,
        'expires_at' => 1699622335,
        'cancelled_at' => null,
        'failed_at' => null,
        'completed_at' => null,
        'last_error' => null,
        'model' => 'gpt-4',
        'instructions' => 'You are a personal math tutor. When asked a question, write and run Python code to answer the question.',
        'tools' => [
            [
                'type' => 'code_interpreter',
            ],
        ],
        'file_ids' => [
            'file-6EsV79Y261TEmi0PY5iHbZdS',
        ],
        'metadata' => [],
    ];
}

///**
// * @return array<string, mixed>
// */
//function threadListResource(): array
//{
//    return [
//        'object' => 'list',
//        'data' => [
//            threadResource(),
//            threadResource(),
//        ],
//        'first_id' => 'thread_agvtHUGezjTCt4SKgQg0NJ2Y',
//        'last_id' => 'thread_qVpWfffa654XBdU3tl2iUdVy',
//        'has_more' => false,
//    ];
//}
//
///**
// * @return array<string, mixed>
// */
//function threadDeleteResource(): array
//{
//    return [
//        'id' => 'thread_agvtHUGezjTCt4SKgQg0NJ2Y',
//        'object' => 'thread.deleted',
//        'deleted' => true,
//    ];
//}
