<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type InputTokenCountResponseType array{object: 'response.input_tokens', input_tokens: int}
 *
 * @implements ResponseContract<InputTokenCountResponseType>
 */
final class InputTokenCountResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<InputTokenCountResponseType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  'response.input_tokens'  $object
     */
    private function __construct(
        public readonly string $object,
        public readonly int $inputTokens,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  InputTokenCountResponseType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            object: $attributes['object'],
            inputTokens: $attributes['input_tokens'],
            meta: $meta,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'object' => $this->object,
            'input_tokens' => $this->inputTokens,
        ];
    }
}
