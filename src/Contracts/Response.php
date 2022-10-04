<?php

declare(strict_types=1);

namespace OpenAI\Contracts;

use ArrayAccess;

/**
 * @template TArray of array
 *
 * @extends ArrayAccess<key-of<TArray>, value-of<TArray>>
 *
 * @internal
 */
interface Response extends ArrayAccess
{
    /**
     * Returns the array representation of the Response.
     *
     * @return TArray
     */
    public function toArray(): array;
}
