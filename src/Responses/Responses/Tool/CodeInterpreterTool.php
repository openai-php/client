<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type CodeInterpreterContainerType array{type: string, files?: array<string>}|string
 * @phpstan-type CodeInterpreterToolType array{type: 'code_interpreter', container?: CodeInterpreterContainerType}
 *
 * @implements ResponseContract<CodeInterpreterToolType>
 */
final class CodeInterpreterTool implements ResponseContract
{
    /**
     * @use ArrayAccessible<CodeInterpreterToolType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array{type: string, files?: array<string>}|string|null  $container
     */
    private function __construct(
        /**
         * @var 'code_interpreter'
         */
        public readonly string $type,
        public readonly array|string|null $container,
    ) {}

    /**
     * @param  CodeInterpreterToolType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
            container: $attributes['container'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        $result = [
            'type' => 'code_interpreter',
        ];

        if ($this->container !== null) {
            $result['container'] = $this->container;
        }

        return $result;
    }
}
