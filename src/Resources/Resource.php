<?php

namespace OpenAI\Resources;

use OpenAI\Contracts\DispatcherContract;
use OpenAI\Contracts\TransporterContract;

abstract class Resource
{
    public function __construct(
        protected readonly TransporterContract $transporter,
        protected readonly DispatcherContract $events,
    ) {
        // ..
    }

    public function event(object $event): void
    {
        $this->events->dispatch($event);
    }
}
