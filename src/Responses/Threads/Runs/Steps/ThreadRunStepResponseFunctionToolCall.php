<?php

declare(strict_types=1);

namespace OpenAI\Responses\Threads\Runs\Steps;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{id: ?string, type: 'function', function: array{name: ?string, arguments: string, output: ?string}}>
 */
final class ThreadRunStepResponseFunctionToolCall implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{id: ?string, type: 'function', function: array{name: ?string, arguments: string, output: ?string}}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'function'  $type
     */
    private function __construct(
        public ?string $id,
        public string $type,
        public ThreadRunStepResponseFunction $function,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id?: string, type: 'function', function: array{name?: string, arguments: string, output?: ?string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'] ?? null,
            $attributes['type'],
            ThreadRunStepResponseFunction::from($attributes['function']),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'function' => $this->function->toArray(),
        ];
    }
}
