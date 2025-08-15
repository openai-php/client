<?php

declare(strict_types=1);

namespace OpenAI\Testing\Responses\Concerns;

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Enums\OverrideStrategy;

trait Fakeable
{
    /**
     * @param  array<string, mixed>  $override
     */
    public static function fake(
        array $override = [],
        ?MetaInformation $meta = null,
        OverrideStrategy $strategy = OverrideStrategy::Merge,
    ): static {
        $class = str_replace('OpenAI\\Responses\\', 'OpenAI\\Testing\\Responses\\Fixtures\\', static::class).'Fixture';

        return static::from(
            self::buildAttributes($class::ATTRIBUTES, $override, $strategy),
            $meta ?? self::fakeResponseMetaInformation(),
        );
    }

    public static function fakeResponseMetaInformation(): MetaInformation
    {
        return MetaInformation::from([
            'openai-model' => ['gpt-3.5-turbo-instruct'],
            'openai-organization' => ['org-1234'],
            'openai-processing-ms' => ['410'],
            'openai-version' => ['2020-10-01'],
            'x-ratelimit-limit-requests' => ['3000'],
            'x-ratelimit-limit-tokens' => ['250000'],
            'x-ratelimit-remaining-requests' => ['2999'],
            'x-ratelimit-remaining-tokens' => ['249989'],
            'x-ratelimit-reset-requests' => ['20ms'],
            'x-ratelimit-reset-tokens' => ['2ms'],
            'x-request-id' => ['3813fa4fa3f17bdf0d7654f0f49ebab4'],
        ]);
    }

    private static function buildAttributes(
        array $original,
        array $override,
        OverrideStrategy $strategy = OverrideStrategy::Merge): array
    {
        return match ($strategy) {
            OverrideStrategy::Replace => array_replace($original, $override),
            OverrideStrategy::Merge => array_replace_recursive($original, $override),
        };
    }
}
