<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Responses\Output\CodeInterpreter\CodeFileOutput;
use OpenAI\Responses\Responses\Output\CodeInterpreter\CodeTextOutput;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type CodeFileOutputType from CodeFileOutput
 * @phpstan-import-type CodeTextOutputType from CodeTextOutput
 *
 * @phpstan-type ResultType array<int, CodeFileOutputType|CodeTextOutputType>
 * @phpstan-type OutputCodeInterpreterToolCallType array{code: string, id: string, results: ResultType, status: string, type: 'code_interpreter_call', container_id: string}
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
     * @param  array<int, CodeFileOutput|CodeTextOutput>  $results
     * @param  'code_interpreter_call'  $type
     */
    private function __construct(
        public readonly string $code,
        public readonly string $id,
        public readonly array $results,
        public readonly string $status,
        public readonly string $type,
        public readonly string $containerId,
    ) {}

    /**
     * @param  OutputCodeInterpreterToolCallType  $attributes
     */
    public static function from(array $attributes): self
    {
        $results = array_map(
            static fn (array $result): CodeFileOutput|CodeTextOutput => match ($result['type']) {
                'files' => CodeFileOutput::from($result),
                'logs' => CodeTextOutput::from($result),
            },
            $attributes['results']
        );

        return new self(
            code: $attributes['code'],
            id: $attributes['id'],
            results: $results,
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
            'results' => array_map(
                static fn (CodeFileOutput|CodeTextOutput $result): array => $result->toArray(),
                $this->results
            ),
            'status' => $this->status,
            'type' => $this->type,
            'container_id' => $this->containerId,
        ];
    }
}
