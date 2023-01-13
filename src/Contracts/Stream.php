<?php

namespace OpenAI\Contracts;

interface Stream
{
    /**
     * Iterates over the event-stream data.
     *
     * @return iterable<integer, string>
     */
    public function read(): iterable;
}
