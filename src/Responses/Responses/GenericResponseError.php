<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type ErrorType array{code?: string|int, message?: string}
 *
 * @implements ResponseContract<ErrorType>
 */
class GenericResponseError implements ResponseContract
{
    /**
     * @use ArrayAccessible<ErrorType>
     */
    use ArrayAccessible;

    use Fakeable;

    protected function __construct(
        public readonly string $code,
        public readonly string $message
    ) {}

    /**
     * @param  ErrorType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            code: (string) ($attributes['code'] ?? 'unknown_error'),
            message: $attributes['message'] ?? 'An unknown error occurred.',
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'message' => $this->message,
        ];
    }
}
