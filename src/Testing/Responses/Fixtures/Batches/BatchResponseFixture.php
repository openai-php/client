<?php

namespace OpenAI\Testing\Responses\Fixtures\Batches;

final class BatchResponseFixture
{
    public const ATTRIBUTES = [
        'id' => 'batch_abc123',
        'object' => 'batch',
        'endpoint' => '/v1/chat/completions',
        'errors' => null,
        'input_file_id' => 'file-abc123',
        'completion_window' => '24h',
        'status' => 'validating',
        'output_file_id' => null,
        'error_file_id' => null,
        'created_at' => 1_711_471_533,
        'in_progress_at' => null,
        'expires_at' => null,
        'finalizing_at' => null,
        'completed_at' => null,
        'failed_at' => null,
        'expired_at' => null,
        'cancelling_at' => null,
        'cancelled_at' => null,
        'request_counts' => [
            'total' => 0,
            'completed' => 0,
            'failed' => 0,
        ],
        'metadata' => [
            'customer_id' => 'user_123456789',
            'batch_description' => 'Nightly eval job',
        ],
    ];
}
