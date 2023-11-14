<?php

declare(strict_types=1);

namespace OpenAI\Responses\FineTuning;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array{code: string, param: ?string, message: string}>
 */
final class RetrieveJobResponseError implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{code: string, param: ?string, message: string}>
     */
    use ArrayAccessible;

    private function __construct(
        public readonly string $code,
        public readonly ?string $param,
        public readonly string $message,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{code: string, param: ?string, message: string}|null  $attributes
     */
    public static function from(?array $attributes): ?self
    {
        if (is_null($attributes)) {
            return null;
        }

        return new self(
            $attributes['code'],
            $attributes['param'],
            $attributes['message'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'param' => $this->param,
            'message' => $this->message,
        ];
    }
}
