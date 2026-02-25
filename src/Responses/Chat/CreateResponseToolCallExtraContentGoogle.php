<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

final class CreateResponseToolCallExtraContentGoogle
{
    private function __construct(
        public readonly string $thought_signature,
    ) {}

    /**
     * @param  array{thought_signature?: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['thought_signature'] ?? '',
        );
    }

    /**
     * @return array{thought_signature: string}
     */
    public function toArray(): array
    {
        return [
            'thought_signature' => $this->thought_signature,
        ];
    }
}
