<?php

declare(strict_types=1);

namespace OpenAI\Testing\Responses\Concerns;

trait Fakeable
{
    /**
     * @param  array<string, mixed>  $override
     */
    public static function fake(array $override = []): static
    {
        $class = str_replace('Responses\\', 'Testing\\Responses\\Fixtures\\', static::class).'Fixture';

        return static::from(
            self::buildAttributes($class::ATTRIBUTES, $override)
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

        // we are going to append all remaining overrides with numeric keys
        foreach ($override as $key => $value) {
            if (! is_numeric($key)) {
                continue;
            }

            $new[$key] = $value;
        }

        return $new;
    }
}
