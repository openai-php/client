<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Responses\Output\CodeInterpreter\CodeFileOutput;
use OpenAI\Responses\Responses\Output\CodeInterpreter\CodeImageOutput;
use OpenAI\Responses\Responses\Output\CodeInterpreter\CodeTextOutput;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type CodeFileOutputType from CodeFileOutput
 * @phpstan-import-type CodeImageOutputType from CodeImageOutput
 * @phpstan-import-type CodeTextOutputType from CodeTextOutput
 *
 * @phpstan-type OutputType array<int, CodeFileOutputType|CodeImageOutputType|CodeTextOutputType>|null
 * @phpstan-type OutputCodeInterpreterToolCallType array{code: string|null, id: string, outputs: OutputType, status: string, type: 'code_interpreter_call', container_id: string}
 *
 * @implements ResponseContract<OutputCodeInterpreterToolCallType>
 */
final class OutputCodeInterpreterToolCall implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputCodeInterpreterToolCallType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, CodeFileOutput|CodeImageOutput|CodeTextOutput>|null  $outputs
     * @param  'code_interpreter_call'  $type
     */
    private function __construct(
        public readonly ?string $code,
        public readonly string $id,
        public readonly ?array $outputs,
        public readonly string $status,
        public readonly string $type,
        public readonly string $containerId,
    ) {}

    /**
     * @param  OutputCodeInterpreterToolCallType  $attributes
     */
    public static function from(array $attributes): self
    {
        $outputs = null;

        if (is_array($attributes['outputs'])) {
            $outputs = array_map(
                static fn (array $output): CodeFileOutput|CodeImageOutput|CodeTextOutput => match ($output['type']) {
                    'files' => CodeFileOutput::from($output),
                    'image' => CodeImageOutput::from($output),
                    'logs' => CodeTextOutput::from($output),
                },
                $attributes['outputs']
            );
        }

        return new self(
            code: $attributes['code'],
            id: $attributes['id'],
            outputs: $outputs,
            status: $attributes['status'],
            type: $attributes['type'],
            containerId: $attributes['container_id'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'id' => $this->id,
            'outputs' => $this->outputs
                ? array_map(static fn (CodeFileOutput|CodeImageOutput|CodeTextOutput $output): array => $output->toArray(), $this->outputs)
                : null,
            'status' => $this->status,
            'type' => $this->type,
            'container_id' => $this->containerId,
        ];
    }
}
