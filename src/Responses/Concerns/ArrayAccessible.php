<?php

declare(strict_types=1);

namespace OpenAI\Responses\Concerns;

use ArrayAccess;
use BadMethodCallException;
use OpenAI\Contracts\Response;

/**
 * @implements ArrayAccess<string, mixed>
 *
 * @mixin Response
 */
trait ArrayAccessible
{
    /**
     * Whether an offset exists.
     */
    public function offsetExists(mixed $offset): bool
    {
        return array_key_exists($offset, $this->toArray());
    }

    /**
     * Offset to retrieve.
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->toArray()[$offset];
    }

    /**
     * Offset to set.
     *
     * @internal
     *
     * @throws BadMethodCallException
     */
    public function offsetSet(mixed $offset, mixed $value): never
    {
        throw new BadMethodCallException('Cannot set response attributes.');
    }

    /**
     * Unset an offset.
     *
     * @internal
     *
     * @throws BadMethodCallException
     */
    public function offsetUnset(mixed $offset): never
    {
        throw new BadMethodCallException('Cannot unset response attributes.');
    }
}
