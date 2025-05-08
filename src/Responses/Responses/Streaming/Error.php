<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Streaming;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type ErrorType array{code: string|null, message: string, param: string|null}
 *
 * @implements ResponseContract<ErrorType>
 */
final class Error implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<ErrorType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    private function __construct(
        public readonly ?string $code,
        public readonly string $message,
        public readonly ?string $param,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  ErrorType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            code: $attributes['code'],
            message: $attributes['message'],
            param: $attributes['param'],
            meta: $meta,
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
            'param' => $this->param,
        ];
    }
}
