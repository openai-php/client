<?php

declare(strict_types=1);

namespace OpenAI\Contracts;

/**
 * @internal
 */
interface Request
{
    /**
     * Return the data in the format expected by the api.
     *
     * @return array<array-key, mixed>
     */
    public function toArray(): array;
}
