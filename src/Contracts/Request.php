<?php

declare(strict_types=1);

namespace OpenAI\Contracts;

/**
 * @template TArray of array
 *
 * @internal
 */
interface Request extends ArrayAcces
{
    /**
     * Returns the array representation of the Request.
     *
     * @return TArray
     */
    public function toArray(): array;
}
