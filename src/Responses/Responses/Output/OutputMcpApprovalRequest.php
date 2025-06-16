<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type OutputMcpApprovalRequestType array{id: string, server_label: string, name: string, arguments: string, type: 'mcp_approval_request'}
 *
 * @implements ResponseContract<OutputMcpApprovalRequestType>
 */
final class OutputMcpApprovalRequest implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputMcpApprovalRequestType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'mcp_approval_request'  $type
     */
    private function __construct(
        public readonly string $id,
        public readonly string $serverLabel,
        public readonly string $name,
        public readonly string $arguments,
        public readonly string $type,
    ) {}

    /**
     * @param  OutputMcpApprovalRequestType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            id: $attributes['id'],
            serverLabel: $attributes['server_label'],
            name: $attributes['name'],
            arguments: $attributes['arguments'],
            type: $attributes['type'],
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
        ];
    }
}
