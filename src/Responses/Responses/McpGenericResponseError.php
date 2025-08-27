<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type McpErrorType array{type: string, content?: array<string, mixed>|null}
 *
 * @implements ResponseContract<McpErrorType>
 */
final class McpGenericResponseError implements ResponseContract
{
    /**
     * @use ArrayAccessible<McpErrorType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<string, mixed>|null  $content
     */
    protected function __construct(
        public readonly string $type,
        public readonly ?array $content = null,
    ) {}

    /**
     * @param  McpErrorType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: (string) $attributes['type'],
            content: $attributes['content'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'content' => $this->content,
        ];
    }
}
