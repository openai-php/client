<?php

namespace OpenAI\Testing\Resources\Concerns;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\StreamResponse;
use OpenAI\Testing\ClientFake;
use OpenAI\Testing\Requests\TestRequest;

trait Testable
{
    public function __construct(protected ClientFake $fake)
    {
    }

    abstract protected function resource(): string;

    /**
     * @param  array<string, mixed>|string  $parameters
     */
    protected function record(string $method, array|string $parameters = null): ResponseContract|StreamResponse|string
    {
        return $this->fake->record(new TestRequest($this->resource(), $method, $parameters));
    }

    public function assertSent(callable|int $callback = null): void
    {
        $this->fake->assertSent($this->resource(), $callback);
    }

    public function assertNotSent(callable|int $callback = null): void
    {
        $this->fake->assertNotSent($this->resource(), $callback);
    }
}
