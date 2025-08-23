<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Responses\GenericResponseError;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type ErrorType from GenericResponseError
 *
 * @phpstan-type OutputMcpCallType array{id: string, server_label: string, type: 'mcp_call', approval_request_id: ?string, arguments: string, error: string|ErrorType|null, name: string, output: ?string}
 *
 * @implements ResponseContract<OutputMcpCallType>
 */
final class OutputMcpCall implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputMcpCallType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'mcp_call'  $type
     */
    private function __construct(
        public readonly string $id,
        public readonly string $serverLabel,
        public readonly string $type,
        public readonly string $arguments,
        public readonly string $name,
        public readonly ?string $approvalRequestId = null,
        public readonly ?GenericResponseError $error = null,
        public readonly ?string $output = null,
    ) {}

    /**
     * @param  OutputMcpCallType  $attributes
     */
    public static function from(array $attributes): self
    {
        // OpenAI has odd structure (presumably a bug) where the errorType can sometimes be a full-fledged HTTP error object.
        // As MCP calls are valid HTTP requests - we need to handle strings & objects here.
        $errorType = null;
        if (isset($attributes['error'])) {
            if (is_array($attributes['error'])) {
                $errorType = GenericResponseError::from($attributes['error']);
            } elseif (is_string($attributes['error'])) {
                $errorType = GenericResponseError::from([
                    'code' => 'unknown_error',
                    'message' => $attributes['error'],
                ]);
            }
        }

        return new self(
            id: $attributes['id'],
            serverLabel: $attributes['server_label'],
            type: $attributes['type'],
            arguments: $attributes['arguments'],
            name: $attributes['name'],
            approvalRequestId: $attributes['approval_request_id'],
            error: $errorType,
            output: $attributes['output'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'server_label' => $this->serverLabel,
            'type' => $this->type,
            'arguments' => $this->arguments,
            'name' => $this->name,
            'approval_request_id' => $this->approvalRequestId,
            'error' => $this->error instanceof GenericResponseError
                ? $this->error->toArray()
                : $this->error,
            'output' => $this->output,
        ];
    }
}
