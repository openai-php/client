<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Input;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type McpApprovalResponseType array{approval_request_id: string, approve: bool, id: string, type: 'mcp_approval_response', reason: string|null}
 *
 * @implements ResponseContract<McpApprovalResponseType>
 */
final class McpApprovalResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<McpApprovalResponseType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'mcp_approval_response'  $type
     */
    private function __construct(
        public readonly string $approvalRequestId,
        public readonly bool $approved,
        public readonly string $id,
        public readonly string $type,
        public readonly ?string $reason = null,
    ) {}

    /**
     * @param  McpApprovalResponseType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            approvalRequestId: $attributes['approval_request_id'],
            approved: (bool) $attributes['approve'],
            id: $attributes['id'],
            type: $attributes['type'],
            reason: $attributes['reason'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'approval_request_id' => $this->approvalRequestId,
            'approve' => $this->approved,
            'id' => $this->id,
            'reason' => $this->reason,
        ];
    }
}
