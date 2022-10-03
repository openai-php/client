<?php

declare(strict_types=1);

namespace OpenAI\Contracts;

/**
 * @internal
 */
interface Response
{
    /**
     * Returns the array representation of the Response.
     *
     * @return array<array-key, mixed>
     */
    public function toArray(): array;
}
