<?php

namespace OpenAI\Streams;

use Closure;
use OpenAI\Contracts\Stream as StreamContract;

final class Stream implements StreamContract
{
    public function __construct(
        private readonly StreamContract $stream,
        private readonly Closure $callback
    ) {
    }

    public function read(): iterable
    {
        foreach ($this->stream->read() as $data) {
            yield ($this->callback)($data);
        }
    }
}
