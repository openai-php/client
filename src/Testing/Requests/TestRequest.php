<?php

namespace OpenAI\Testing\Requests;

final class TestRequest
{
    /**
     * @param  array<string, mixed>|string|null  $parameters
     */
    public function __construct(protected string $resource, protected string $method, protected array|string|null $parameters)
    {
    }

    public function resource(): string
    {
        return $this->resource;
    }

    public function method(): string
    {
        return $this->method;
    }

    /**
     * @return array<string, mixed>|string|null
     */
    public function parameters(): array|string|null
    {
        return $this->parameters;
    }
}
