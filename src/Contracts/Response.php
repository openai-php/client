<?php

declare(strict_types=1);

namespace OpenAI\Contracts;

/**
 * @internal
 */
interface Response
{
    /**
     * Returns the response on the array format, the original format.
     *
     * @return array<array-key, mixed>
     */
    public function toArray(): array;
}
