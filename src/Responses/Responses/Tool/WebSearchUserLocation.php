<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{type: 'approximate', city: string|null, country: string, region: string|null, timezone: string|null}>
 */
final class WebSearchUserLocation implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{type: 'approximate', city: string|null, country: string, region: string|null, timezone: string|null}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'approximate'  $type
     */
    private function __construct(
        public readonly string $type,
        public readonly ?string $city,
        public readonly string $country,
        public readonly ?string $region,
        public readonly ?string $timezone,
    ) {}

    /**
     * @param  array{type: 'approximate', city: string|null, country: string, region: string|null, timezone: string|null}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
            city: $attributes['city'],
            country: $attributes['country'],
            region: $attributes['region'],
            timezone: $attributes['timezone'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'city' => $this->city,
            'country' => $this->country,
            'region' => $this->region,
            'timezone' => $this->timezone,
        ];
    }
}
