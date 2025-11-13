<?php

namespace OpenAI\Resources\Concerns;

use OpenAI\Exceptions\InvalidArgumentException;

trait Streamable
{
    /**
     * @param  array<string, mixed>  $parameters
     */
    private function ensureNotStreamed(array $parameters, string $fallbackFunction = 'createStreamed', mixed $streamValue = true): void
    {
        if (! isset($parameters['stream'])) {
            return;
        }

        if ($parameters['stream'] !== $streamValue) {
            return;
        }

        throw new InvalidArgumentException("Stream option is not supported. Please use the $fallbackFunction() method instead.");
    }

    /**
     * Set the stream parameter to true.
     *
     * @param  array<string, mixed>  $parameters
     * @return array<string, mixed>
     */
    private function setStreamParameter(array $parameters, mixed $streamValue = true): array
    {
        $parameters['stream'] = $streamValue;

        return $parameters;
    }
}
