<?php

namespace OpenAI\Responses;

class EventStreamResponseItem
{
    public readonly string $event;

    public readonly object $data;

    public function __construct(string $event, $data)
    {
        $this->event = $event;
        $this->data = $data;
    }
}
