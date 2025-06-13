<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type RemoteMcpToolType array{type: 'mcp', server_label: string, server_url: string, require_approval: 'never'|null, allowed_tools: string[]|null, headers: array<string, string>|null}
 *
 * @implements ResponseContract<RemoteMcpToolType>
 */
final class RemoteMcpTool implements ResponseContract
{
    /**
     * @use ArrayAccessible<RemoteMcpToolType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'mcp'  $type
     * @param  'never'|null  $requireApproval
     * @param  string[]|null  $allowedTools
     * @param  array<string, string>|null  $headers
     */
    private function __construct(
        public readonly string $type,
        public readonly string $serverLabel,
        public readonly string $serverUrl,
        public readonly ?string $requireApproval = null,
        public readonly ?array $allowedTools = null,
        public readonly ?array $headers = null,
    ) {}

    /**
     * @param  RemoteMcpToolType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
            serverLabel: $attributes['server_label'],
            serverUrl: $attributes['server_url'],
            requireApproval: $attributes['require_approval'] ?? null,
            allowedTools: $attributes['allowed_tools'] ?? null,
            headers: $attributes['headers'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'server_label' => $this->serverLabel,
            'server_url' => $this->serverUrl,
            'require_approval' => $this->requireApproval,
            'allowed_tools' => $this->allowedTools,
            'headers' => $this->headers,
        ];
    }
}
