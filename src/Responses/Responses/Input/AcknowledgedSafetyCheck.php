<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Input;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type AcknowledgedSafetyCheckType array{code: string, id: string, message: string}
 *
 * @implements ResponseContract<AcknowledgedSafetyCheckType>
 */
final class AcknowledgedSafetyCheck implements ResponseContract
{
    /**
     * @use ArrayAccessible<AcknowledgedSafetyCheckType>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public readonly string $code,
        public readonly string $id,
        public readonly string $message,
    ) {}

    /**
     * @param  AcknowledgedSafetyCheckType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            code: $attributes['code'],
            id: $attributes['id'],
            message: $attributes['message'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'id' => $this->id,
            'message' => $this->message,
        ];
    }
}
