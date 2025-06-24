<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type OutputMcpCallType array{id: string, server_label: string, type: 'mcp_call', approval_request_id: ?string, arguments: string, error?: mixed, name: string, output?: ?string}
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
        // Handle error field which might be a string or an MCP content array
        $error = $attributes['error'] ?? null;
        $extractedError = null;

        if (is_array($error)) {
            // OpenAI might be passing through the MCP content array format

            // Check if it's a direct content array [{type: 'text', text: '...'}]
            if (isset($error[0])) {
                /** @var array<int, mixed> $errorArray */
                $errorArray = $error;
                foreach ($errorArray as $content) {
                    if (is_array($content) && isset($content['type']) && $content['type'] === 'text' && isset($content['text'])) {
                        $extractedError = $content['text'];
                        break;
                    }
                }
            }
            // Check if it has a content property {content: [{type: 'text', text: '...'}]}
            elseif (isset($error['content']) && is_array($error['content'])) {
                foreach ($error['content'] as $content) {
                    if (is_array($content) && isset($content['type']) && $content['type'] === 'text' && isset($content['text'])) {
                        $extractedError = $content['text'];
                        break;
                    }
                }
            }

            // Fallback to JSON encoding if we can't extract the text
            $extractedError = $extractedError ?? json_encode($error, JSON_THROW_ON_ERROR);
        } else {
            $extractedError = $error;
        }

        return new self(
            id: $attributes['id'],
            serverLabel: $attributes['server_label'],
            type: $attributes['type'],
            arguments: $attributes['arguments'],
            name: $attributes['name'],
            approvalRequestId: $attributes['approval_request_id'],
            error: $extractedError,
            output: $attributes['output'] ?? null,
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
