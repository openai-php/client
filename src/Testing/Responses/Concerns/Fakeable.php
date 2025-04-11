<?php

declare(strict_types=1);

namespace OpenAI\Testing\Responses\Concerns;

use OpenAI\Responses\Meta\MetaInformation;

trait Fakeable
{
    /**
     * Create a fake response instance with optional attribute overrides.
     *
     * This method handles both simple and nested namespace structures for response fixtures:
     * - Simple: OpenAI\Responses\Category\Response -> OpenAI\Testing\Responses\Fixtures\Category\ResponseFixture
     * - Nested: OpenAI\Responses\Category\SubCategory\Response -> OpenAI\Testing\Responses\Fixtures\Category\SubCategory\ResponseFixture
     *
     * The method preserves the namespace hierarchy after 'Responses' to maintain proper fixture organization:
     * Example paths:
     * - Responses\Threads\ThreadResponse -> Fixtures\Threads\ThreadResponseFixture
     * - Responses\Threads\Runs\ThreadRunResponse -> Fixtures\Threads\Runs\ThreadRunResponseFixture
     *
     * It also handles cases where fixture ATTRIBUTES might be wrapped in an additional array layer,
     * automatically unwrapping single-element arrays to maintain consistency.
     *
     * @param array<string, mixed> $override Optional attributes to override in the fake response
     * @param MetaInformation|null $meta Optional meta information for the response
     * @throws \RuntimeException If the Responses namespace cannot be found in the class path
     * @return static Returns a new instance of the response class with fake data
     */
    public static function fake(array $override = [], ?MetaInformation $meta = null): static
    {
        $parts = explode('\\', static::class);
        $className = end($parts);
        
        // Find the position of 'Responses' in the namespace
        $responsesPos = array_search('Responses', $parts);
        if ($responsesPos === false) {
            throw new \RuntimeException('Unable to determine fixture path: no Responses namespace found');
        }
        
        // Get all parts after 'Responses' to preserve nested structure
        $subPath = implode('\\', array_slice($parts, $responsesPos + 1, -1));
        
        // Construct the fixture class path
        $namespace = 'OpenAI\\Testing\\Responses\\Fixtures\\' . $subPath . '\\';
        $class = $namespace . $className . 'Fixture';

        $attributes = $class::ATTRIBUTES;
        // If attributes is a nested array with only one element, use that element
        if (is_array($attributes) && count($attributes) === 1 && isset($attributes[0]) && is_array($attributes[0])) {
            $attributes = $attributes[0];
        }

        return static::from(
            self::buildAttributes($attributes, $override),
            $meta ?? self::fakeResponseMetaInformation(),
        );
    }

    /**
     * @return mixed[]
     */
    private static function buildAttributes(array $original, array $override): array
    {
        $new = [];

        foreach ($original as $key => $entry) {
            $new[$key] = is_array($entry) ?
                self::buildAttributes($entry, $override[$key] ?? []) :
                $override[$key] ?? $entry;
            unset($override[$key]);
        }

        // we are going to append all remaining overrides
        foreach ($override as $key => $value) {
            $new[$key] = $value;
        }

        return $new;
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
}
