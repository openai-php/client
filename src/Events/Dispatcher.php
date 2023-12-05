<?php

namespace OpenAI\Events;

use Illuminate\Contracts\Events\Dispatcher as LaravelDispatcher;
use OpenAI\Contracts\DispatcherContract;
use Psr\EventDispatcher\EventDispatcherInterface;

class Dispatcher implements DispatcherContract
{
    public function __construct(
        private readonly LaravelDispatcher|EventDispatcherInterface|null $events
    )
    {
    }

    public function dispatch(object $event): void
    {
        $this->events?->dispatch($event);
    }
}
