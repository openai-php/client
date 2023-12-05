<?php

declare(strict_types=1);

namespace OpenAI\Resources\Concerns;

use OpenAI\Contracts\DispatcherContract;

trait Dispatchable
{
    private DispatcherContract $events;

    public function setEventDispatcher(DispatcherContract $events): static
    {
        $this->events = $events;

        return $this;
    }

    public function event(object $event): void
    {
        $this->events->dispatch($event);
    }
}
