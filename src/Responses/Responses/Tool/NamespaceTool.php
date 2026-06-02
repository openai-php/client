<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool;

use OpenAI\Actions\Responses\NamespaceToolObjects;
use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Responses\Tool\NamespaceTools\CustomTool;
use OpenAI\Responses\Responses\Tool\NamespaceTools\FunctionTool;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type FunctionToolType from FunctionTool
 * @phpstan-import-type CustomToolType from CustomTool
 * @phpstan-import-type ResponseNamespaceToolObjectReturnType from NamespaceToolObjects
 *
 * @phpstan-type NamespaceToolType array{description: string, name: string, tools: array<int, FunctionToolType|CustomToolType>, type: 'namespace'}
 *
 * @implements ResponseContract<NamespaceToolType>
 */
final class NamespaceTool implements ResponseContract
{
    /**
     * @use ArrayAccessible<NamespaceToolType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'namespace'  $type
     * @param  array<int, FunctionTool|CustomTool>  $tools
     */
    private function __construct(
        public readonly string $description,
        public readonly string $name,
        public readonly array $tools,
        public readonly string $type,
    ) {}

    /**
     * @param  NamespaceToolType  $attributes
     */
    public static function from(array $attributes): self
    {
        /** @var array<int, FunctionTool|CustomTool> $tools */
        $tools = NamespaceToolObjects::parse($attributes['tools']);

        return new self(
            description: $attributes['description'],
            name: $attributes['name'],
            tools: $tools,
            type: $attributes['type'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'description' => $this->description,
            'name' => $this->name,
            'tools' => array_map(
                fn (FunctionTool|CustomTool $tool): array => $tool->toArray(),
                $this->tools,
            ),
            'type' => $this->type,
        ];
    }
}
