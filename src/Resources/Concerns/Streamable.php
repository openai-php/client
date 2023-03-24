<?php

namespace OpenAI\Resources\Concerns;

use OpenAI\Exceptions\InvalidArgumentException;

trait Streamable
{
    /**
     * @param  array<string, mixed>  $parameters
     */
    private function ensureNotStreamed(array $parameters): void
    {
        if (! isset($parameters['stream'])) {
            return;
        }

        if ($parameters['stream'] !== true) {
            return;
        }

        throw new InvalidArgumentException('Stream option is not supported. Please use the createStreamed() method instead.');
    }

    /**
     * Set the stream parameter to true.
     *
     * @param  array<string, mixed>  $parameters
     * @return array<string, mixed>
     */
    private function setStreamParameter(array $parameters): array
    {
        $parameters['stream'] = true;

        return $parameters;
    }
}
