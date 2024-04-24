<?php

namespace OpenAI\Responses;

class EventStreamResponseItem
{
    public function __construct(public readonly string $event, public readonly object $data)
    {
    }
}
