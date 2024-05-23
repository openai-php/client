<?php

namespace OpenAI\Testing\Responses\Fixtures\Batches;

final class CancelResponseFixture
{
    public const ATTRIBUTES = [
        "id" => "batch_abc123",
        "object" => "batch",
        "endpoint" => "/v1/chat/completions",
        "errors" => null,
        "input_file_id" => "file-abc123",
        "completion_window" => "24h",
        "status" => "cancelling",
        "output_file_id" => null,
        "error_file_id" => null,
        "created_at" => 1711471533,
        "in_progress_at" => 1711471538,
        "expires_at" => 1711557933,
        "finalizing_at" => null,
        "completed_at" => null,
        "failed_at" => null,
        "expired_at" => null,
        "cancelling_at" => 1711475133,
        "cancelled_at" => null,
        "request_counts" => [
            "total" => 100,
            "completed" => 23,
            "failed" => 1
        ],
        "metadata" => [
            "customer_id" => "user_123456789",
            "batch_description" => "Nightly eval job",
        ]
    ];
}
