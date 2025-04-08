<?php

namespace OpenAI\Testing\Requests;

final class TestRequest
{
    /**
     * @param  array<string, mixed>  $args
     */
    public function __construct(protected string $resource, protected string $method, protected array $args) {}

    public function resource(): string
    {
        return $this->resource;
    }

    public function method(): string
    {
        return $this->method;
    }

    /**
     * @return array<string, mixed>
     */
    public function args(): array
    {
        return $this->args;
    }
}
