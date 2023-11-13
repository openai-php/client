<?php

declare(strict_types=1);

namespace OpenAI\Responses\Threads\Runs\Steps;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{id: string, type: string, code_interpreter: array{input: string, outputs: array<int, array{type: string, image: array{file_id: string}}|array{type: string, logs: string}>}}>
 */
final class ThreadRunStepResponseCodeToolCall implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{id: string, type: string, code_interpreter: array{input: string, outputs: array<int, array{type: string, image: array{file_id: string}}|array{type: string, logs: string}>}}>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public string $id,
        public string $type,
        public ThreadRunStepResponseCodeInterpreter $codeInterpreter,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id: string, type: 'code_interpreter', code_interpreter: array{input: string, outputs: array<int, array{type: 'image', image: array{file_id: string}}|array{type: 'logs', logs: string}>}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['type'],
            ThreadRunStepResponseCodeInterpreter::from($attributes['code_interpreter']),
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
            'code_interpreter' => $this->codeInterpreter->toArray(),
        ];
    }
}
