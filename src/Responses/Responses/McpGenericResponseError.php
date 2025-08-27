<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

use OpenAI\Contracts\ResponseContract;

/**
 * @phpstan-type McpErrorType array{type: string, content?: array<string, mixed>|null}
 *
 * @implements ResponseContract<McpErrorType>
 */
final class McpGenericResponseError extends GenericResponseError implements ResponseContract
{
    /**
     * @param  array<string, mixed>|null  $content
     */
    protected function __construct(
        string $code,
        string $message,
        public readonly ?array $content = null,
    ) {
        parent::__construct($code, $message);
    }

    /**
     * @param  McpErrorType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            code: (string) $attributes['type'],
            message: 'An error occurred during the execution of an MCP call.',
            content: $attributes['content'] ?? null,
        );
    }
}
