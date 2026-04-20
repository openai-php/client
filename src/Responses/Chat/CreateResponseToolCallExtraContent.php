<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

final class CreateResponseToolCallExtraContent
{
    private function __construct(
        public readonly ?CreateResponseToolCallExtraContentGoogle $google,
    ) {}

    /**
     * @param  array{google?: array{thought_signature: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            isset($attributes['google']) ? CreateResponseToolCallExtraContentGoogle::from($attributes['google']) : null
        );
    }

    /**
     * @return array{google?: array{thought_signature: string}|null}
     */
    public function toArray(): array
    {
        return array_filter([
            'google' => $this->google?->toArray(),
        ], fn ($value) => $value !== null);
    }
}
