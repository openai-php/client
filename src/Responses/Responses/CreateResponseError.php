<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

final class CreateResponseError
{
    private function __construct(
        public readonly string $code,
        public readonly string $message
    ) {}

    /**
     * @param  array{code: string, message: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['code'],
            $attributes['message'],
        );
    }

    /**
     * @return array{code: string, message: string}
     */
    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'message' => $this->message,
        ];
    }
}
