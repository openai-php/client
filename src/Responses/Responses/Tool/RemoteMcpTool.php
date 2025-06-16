<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type McpToolNamesFilterType from McpToolNamesFilter
 *
 * @phpstan-type RemoteMcpToolType array{type: 'mcp', server_label: string, server_url: string, require_approval: 'never'|'always'|array<'never'|'always', McpToolNamesFilterType>|null, allowed_tools: array<int, string>|McpToolNamesFilterType|null, headers: array<string, string>|null}
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
     * @param  'never'|'always'|array<'never'|'always', McpToolNamesFilter>|null  $requireApproval
     * @param  array<int, string>|McpToolNamesFilter|null  $allowedTools
     * @param  array<string, string>|null  $headers
     */
    private function __construct(
        public readonly string $type,
        public readonly string $serverLabel,
        public readonly string $serverUrl,
        public readonly string|array|null $requireApproval = null,
        public readonly array|McpToolNamesFilter|null $allowedTools = null,
        public readonly ?array $headers = null,
    ) {}

    /**
     * @param  RemoteMcpToolType  $attributes
     */
    public static function from(array $attributes): self
    {
        $requireApproval = $attributes['require_approval'] ?? null;
        if (is_array($requireApproval)) {
            $requireApproval = array_map(function (array $approvalAttributes): McpToolNamesFilter {
                return McpToolNamesFilter::from($approvalAttributes);
            }, $requireApproval);
        }

        $allowedTools = $attributes['allowed_tools'] ?? null;
        if ($allowedTools !== null && isset($allowedTools['tool_names']) && is_array($allowedTools['tool_names'])) {
            $allowedTools = McpToolNamesFilter::from($allowedTools);
        }

        return new self(
            type: $attributes['type'],
            serverLabel: $attributes['server_label'],
            serverUrl: $attributes['server_url'],
            requireApproval: $requireApproval,
            allowedTools: $allowedTools, // @phpstan-ignore-line
            headers: $attributes['headers'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        $requireApproval = $this->requireApproval;
        if (is_array($requireApproval)) {
            $requireApproval = array_map(function (McpToolNamesFilter $approvalFilter): array {
                return $approvalFilter->toArray();
            }, $requireApproval);
        }

        $allowedTools = $this->allowedTools;
        if ($allowedTools instanceof McpToolNamesFilter) {
            $allowedTools = $allowedTools->toArray();
        }

        return [
            'type' => $this->type,
            'server_label' => $this->serverLabel,
            'server_url' => $this->serverUrl,
            'require_approval' => $requireApproval,
            'allowed_tools' => $allowedTools,
            'headers' => $this->headers,
        ];
    }
}
