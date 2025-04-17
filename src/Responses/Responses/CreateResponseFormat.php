<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Responses\Format\JsonObjectFormat;
use OpenAI\Responses\Responses\Format\JsonSchemaFormat;
use OpenAI\Responses\Responses\Format\TextFormat;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{format: array{type: 'text'}|array{name: string, schema: array<string, mixed>, type: 'json_schema', description: string, strict: ?bool}|array{type: 'json_object'}}>
 */
final class CreateResponseFormat implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{format: array{type: 'text'}|array{name: string, schema: array<string, mixed>, type: 'json_schema', description: string, strict: ?bool}|array{type: 'json_object'}}>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public readonly TextFormat|JsonSchemaFormat|JsonObjectFormat $format
    ) {}

    /**
     * @param  array{format: array{type: 'text'}|array{name: string, schema: array<string, mixed>, type: 'json_schema', description: string, strict: ?bool}|array{type: 'json_object'}}  $attributes
     */
    public static function from(array $attributes): self
    {
        $format = match ($attributes['format']['type']) {
            'text' => TextFormat::from($attributes['format']),
            'json_schema' => JsonSchemaFormat::from($attributes['format']),
            'json_object' => JsonObjectFormat::from($attributes['format']),
        };

        return new self(
            format: $format
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'format' => $this->format->toArray(),
        ];
    }
}
