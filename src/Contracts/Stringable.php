<?php

declare(strict_types=1);

namespace OpenAI\Contracts;

/**
 * @internal
 */
interface Stringable
{
    /**
     * Returns the string representation of the object.
     */
    public function toString(): string;
}
