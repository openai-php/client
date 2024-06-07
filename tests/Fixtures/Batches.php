<?php

/**
 * @return array<string, mixed>
 */
function batchResource(): array
{
    return [
        'id' => 'batch_abc123',
        'object' => 'batch',
        'endpoint' => '/v1/completions',
        'errors' => null,
        'input_file_id' => 'file-abc123',
        'completion_window' => '24h',
        'status' => 'completed',
        'output_file_id' => 'file-cvaTdG',
        'error_file_id' => 'file-HOWS94',
        'created_at' => 1711471533,
        'in_progress_at' => 1711471538,
        'expires_at' => 1711557933,
        'finalizing_at' => 1711493133,
        'completed_at' => 1711493163,
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
            'batch_description' => 'Nightly eval job',
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function batchResourceWithErrors(): array
{
    return [
        'id' => 'batch_abc123',
        'object' => 'batch',
        'endpoint' => '/v1/completions',
        'errors' => [
            'object' => 'list',
            'data' => [
                [
                    'code' => '123',
                    'message' => 'the message',
                    'param' => 'the param',
                    'line' => 99,
                ],
            ],
        ],
        'input_file_id' => 'file-abc123',
        'completion_window' => '24h',
        'status' => 'completed',
        'output_file_id' => 'file-cvaTdG',
        'error_file_id' => 'file-HOWS94',
        'created_at' => 1711471533,
        'in_progress_at' => 1711471538,
        'expires_at' => 1711557933,
        'finalizing_at' => 1711493133,
        'completed_at' => 1711493163,
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
            'batch_description' => 'Nightly eval job',
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function batchListResource(): array
{
    return [
        'object' => 'list',
        'data' => [
            batchResource(),
            batchResource(),
            batchResource(),
            batchResource(),
        ],
        'first_id' => 'batch_SMzoVX8XmCZEg1EbMHoAm8tc',
        'last_id' => 'batch_y49lAdZDiaQUxEBR6zrG846Q',
        'has_more' => true,
    ];
}
