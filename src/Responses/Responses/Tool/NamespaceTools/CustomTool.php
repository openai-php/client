<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool\NamespaceTools;

use OpenAI\Actions\Responses\CustomToolInputObjects;
use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Responses\Tool\CustomToolInputs\GrammarInput;
use OpenAI\Responses\Responses\Tool\CustomToolInputs\TextInput;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type CustomToolInputTypes from CustomToolInputObjects
 *
 * @phpstan-type CustomToolType array{name: string, type: 'custom', defer_loading?: bool, description?: string, format?: CustomToolInputTypes, allowed_callers?: array<int, 'direct'|'programmatic'>|null}
 *
 * @implements ResponseContract<CustomToolType>
 */
final class CustomTool implements ResponseContract
{
    /**
     * @use ArrayAccessible<CustomToolType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'custom'  $type
     * @param  array<int, 'direct'|'programmatic'>|null  $allowedCallers
     */
    private function __construct(
        public readonly string $name,
        public readonly string $type,
        public readonly ?bool $deferLoading = null,
        public readonly ?string $description = null,
        public readonly TextInput|GrammarInput|null $format = null,
        public readonly ?array $allowedCallers = null,
    ) {}

    /**
     * @param  CustomToolType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            name: $attributes['name'],
            type: $attributes['type'],
            deferLoading: $attributes['defer_loading'] ?? null,
            description: $attributes['description'] ?? null,
            format: isset($attributes['format'])
                ? CustomToolInputObjects::parse($attributes['format'])
                : null,
            allowedCallers: $attributes['allowed_callers'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'type' => $this->type,
            'defer_loading' => $this->deferLoading,
            'description' => $this->description,
            'format' => $this->format?->toArray(),
            'allowed_callers' => $this->allowedCallers,
        ], fn (mixed $value): bool => $value !== null);
    }
}
