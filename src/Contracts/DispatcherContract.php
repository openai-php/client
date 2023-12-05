<?php

declare(strict_types=1);

namespace OpenAI\Contracts;

/**
 * @internal
 */
interface DispatcherContract
{
    /**
     * Dispatch an event.
     */
    public function dispatch(object $event): void;
}
