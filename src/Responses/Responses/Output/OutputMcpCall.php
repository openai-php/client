<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type OutputMcpCallType array{id: string, server_label: string, type: 'mcp_call', approval_request_id: ?string, arguments: string, error: ?string, name: string, output: ?string}
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
        public readonly ?string $error = null,
        public readonly ?string $output = null,
    ) {}

    /**
     * @param  OutputMcpCallType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            id: $attributes['id'],
            serverLabel: $attributes['server_label'],
            type: $attributes['type'],
            arguments: $attributes['arguments'],
            name: $attributes['name'],
            approvalRequestId: $attributes['approval_request_id'],
            error: $attributes['error'],
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
            'error' => $this->error,
            'output' => $this->output,
        ];
    }
}
