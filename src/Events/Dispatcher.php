<?php

namespace OpenAI\Events;

use OpenAI\Contracts\DispatcherContract;
use Psr\EventDispatcher\EventDispatcherInterface;

class Dispatcher implements DispatcherContract
{
    public function __construct(
        private readonly ?EventDispatcherInterface $events
    ) {
    }

    public function dispatch(object $event): void
    {
        $this->events?->dispatch($event);
    }
}
