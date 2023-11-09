<?php

declare(strict_types=1);

namespace OpenAI\Responses\Assistants;

use OpenAI\Responses\Chat\CreateResponseToolCallFunction;

final class AssistantToolResponse
{
    private function __construct(
        public readonly string $type,
    ) {
    }

    /**
     * @param  array{id: string, type: string, function: array{name: string, arguments: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
        );
    }

    /**
     * @return array{id: string, type: string, function: array{name: string, arguments: string}}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
        ];
    }
}
