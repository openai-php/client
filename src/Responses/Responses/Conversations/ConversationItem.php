<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Conversations;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type ConversationItemType array{type: string, id: string, status?: string, role?: string, content?: array<int, array<string, mixed>>}
 *
 * @implements ResponseContract<ConversationItemType>
 */
final class ConversationItem implements ResponseContract
{
    /**
     * @use ArrayAccessible<ConversationItemType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, array<string, mixed>>|null  $content
     */
    private function __construct(
        public readonly string $type,
        public readonly string $id,
        public readonly ?string $status,
        public readonly ?string $role,
        public readonly ?array $content,
    ) {}

    /**
     * @param  ConversationItemType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
            id: $attributes['id'],
            status: $attributes['status'] ?? null,
            role: $attributes['role'] ?? null,
            content: $attributes['content'] ?? null,
        );
    }

    public function toArray(): array
    {
        $data = [
            'type' => $this->type,
            'id' => $this->id,
        ];

        if ($this->status !== null) {
            $data['status'] = $this->status;
        }
        if ($this->role !== null) {
            $data['role'] = $this->role;
        }
        if ($this->content !== null) {
            $data['content'] = $this->content;
        }

        return $data;
    }
}
