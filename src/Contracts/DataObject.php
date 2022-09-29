<?php

declare(strict_types=1);

namespace OpenAI\Contracts;

/**
 * @internal
 */
interface DataObject
{
    /**
     * Return the data as array.
     *
     * @return array<array-key, mixed>
     */
    public function toArray(): array;
}
