<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

final class CreateStreamedResponseDelta
{
    private function __construct(
        public readonly ?string $role,
        public readonly ?string $content,
    ) {
    }

    /**
     * @param  array{role?: string, content?: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['role'] ?? null,
            $attributes['content'] ?? null,
        );
    }

    /**
     * @return array{role?: string, content?: string}
     */
    public function toArray(): array
    {
        return array_filter([
            'role' => $this->role,
            'content' => $this->content,
        ]);
    }
}
