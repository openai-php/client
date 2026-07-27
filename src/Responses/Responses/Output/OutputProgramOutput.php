<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type OutputProgramOutputType array{id: string, call_id: string, result: string, status: 'completed'|'incomplete', type: 'program_output'}
 *
 * @implements ResponseContract<OutputProgramOutputType>
 */
final class OutputProgramOutput implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputProgramOutputType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'completed'|'incomplete'  $status
     * @param  'program_output'  $type
     */
    private function __construct(
        public readonly string $id,
        public readonly string $callId,
        public readonly string $result,
        public readonly string $status,
        public readonly string $type,
    ) {}

    /**
     * @param  OutputProgramOutputType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            id: $attributes['id'],
            callId: $attributes['call_id'],
            result: $attributes['result'],
            status: $attributes['status'],
            type: $attributes['type'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'id' => $this->id,
            'call_id' => $this->callId,
            'result' => $this->result,
            'status' => $this->status,
        ];
    }
}
