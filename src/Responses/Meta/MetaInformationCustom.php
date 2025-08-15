<?php

namespace OpenAI\Responses\Meta;

final readonly class MetaInformationCustom
{
    /**
     * @param  array<string, string>  $headers
     */
    private function __construct(
        public array $headers
    ) {}

    /**
     * @param  array<string, string|null>  $headers
     */
    public static function from(array $headers): self
    {
        return new self(array_filter($headers));
    }

    /**
     * @return array<string, string>
     */
    public function toArray(): array
    {
        return $this->headers;
    }

    public function isEmpty(): bool
    {
        return $this->headers === [];
    }
}
