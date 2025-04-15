<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

final class CreateResponseIncompleteDetails
{
    private function __construct(
        public readonly string $reason,
    ) {}

    /**
     * @param  array{reason: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['reason'],
        );
    }

    /**
     * @return array{reason: string}
     */
    public function toArray(): array
    {
        return [
            'reason' => $this->reason,
        ];
    }
}
