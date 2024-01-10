<?php

namespace OpenAI\Events;

use Psr\EventDispatcher\EventDispatcherInterface;

class NullEventDispatcher implements EventDispatcherInterface
{
    public function dispatch(object $event) // @pest-ignore-type
    {
        return $event;
    }
}
