<?php

namespace OpenAI\Testing\Responses\Fixtures\Batches;

final class BatchListResponseFixture
{
    public const ATTRIBUTES = [
        'object' => 'list',
        'data' => [
            [
                'id' => 'batch_abc123',
                'object' => 'batch',
                'endpoint' => '/v1/chat/completions',
                'errors' => null,
                'input_file_id' => 'file-abc123',
                'completion_window' => '24h',
                'status' => 'completed',
                'output_file_id' => 'file-cvaTdG',
                'error_file_id' => 'file-HOWS94',
                'created_at' => 1_711_471_533,
                'in_progress_at' => 1_711_471_538,
                'expires_at' => 1_711_557_933,
                'finalizing_at' => 1_711_493_133,
                'completed_at' => 1_711_493_163,
                'failed_at' => null,
                'expired_at' => null,
                'cancelling_at' => null,
                'cancelled_at' => null,
                'request_counts' => [
                    'total' => 100,
                    'completed' => 95,
                    'failed' => 5,
                ],
                'metadata' => [
                    'customer_id' => 'user_123456789',
                    'batch_description' => 'Nightly job',
                ],
            ],
        ],
        'first_id' => 'batch_abc123',
        'last_id' => 'batch_abc456',
        'has_more' => true,
    ];
}
