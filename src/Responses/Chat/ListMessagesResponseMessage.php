<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @phpstan-import-type ListMessagesResponseContentPartType from ListMessagesResponseContentPart
 *
 * @phpstan-type ListMessagesResponseMessageType array{id: string, role: string, content: ?string, name?: ?string, content_parts?: ?array<int, ListMessagesResponseContentPartType>}
 *
 * @implements ResponseContract<ListMessagesResponseMessageType>
 */
final class ListMessagesResponseMessage implements ResponseContract
{
    /**
     * @use ArrayAccessible<ListMessagesResponseMessageType>
     */
    use ArrayAccessible;

    /**
     * @param  array<int, ListMessagesResponseContentPart>|null  $contentParts
     */
    private function __construct(
        public readonly string $id,
        public readonly string $role,
        public readonly ?string $content,
        public readonly ?string $name,
        public readonly ?array $contentParts,
    ) {}

    /**
     * @param  ListMessagesResponseMessageType  $attributes
     */
    public static function from(array $attributes): self
    {
        $contentParts = isset($attributes['content_parts'])
            ? array_map(fn (array $part): ListMessagesResponseContentPart => ListMessagesResponseContentPart::from($part), $attributes['content_parts'])
            : null;

        return new self(
            id: $attributes['id'],
            role: $attributes['role'],
            content: $attributes['content'] ?? null,
            name: $attributes['name'] ?? null,
            contentParts: $contentParts,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'role' => $this->role,
            'content' => $this->content,
            'name' => $this->name,
            'content_parts' => $this->contentParts === null ? null : array_map(
                static fn (ListMessagesResponseContentPart $part): array => $part->toArray(),
                $this->contentParts,
            ),
        ];
    }
}
