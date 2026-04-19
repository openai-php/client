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
 * @phpstan-type RateLimitsType array{type: string}
 *
 * @implements ResponseContract<RateLimitsType>
 */
final class RateLimits implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<RateLimitsType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    private function __construct(
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  RateLimitsType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            meta: $meta,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => 'response.rate_limits.updated',
        ];
    }
}
