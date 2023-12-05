<?php

declare(strict_types=1);

namespace OpenAI\Resources\Concerns;

use OpenAI\Contracts\DispatcherContract;
use OpenAI\Contracts\TransporterContract;

trait Transportable
{
    /**
     * Creates a Client instance with the given API token.
     */
    public function __construct(
        private readonly TransporterContract $transporter,
        private readonly DispatcherContract $events,
    ) {
        // ..
    }

    public function event(object $event): void
    {
        $this->events->dispatch($event);
    }
}
