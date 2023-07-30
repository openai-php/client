<?php

namespace OpenAI\Responses;

final class RequestLimitMetaInformation
{
    public function __construct(
        public readonly int $limit,
        public readonly int $remaining,
        public readonly string $reset,
    ) {
    }

    /**
     * @param  array{limit: int, remaining: int, reset: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['limit'],
            $attributes['remaining'],
            $attributes['reset'],
        );
    }
}
