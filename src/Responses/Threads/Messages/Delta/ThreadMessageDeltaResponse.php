<?php

declare(strict_types=1);

namespace OpenAI\Responses\Threads\Messages\Delta;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{id: string, object: string, delta: array{role: string|null, content: array<int, array{index: int, type: 'image_file', image_file: array{file_id: string}}|array{index: int, type: 'text', text: array{value: ?string, annotations: array<int, array{type: 'file_citation', text: string, file_citation: array{file_id: string, quote?: string}, start_index: int, end_index: int}|array{type: 'file_path', text: string, file_path: array{file_id: string}, start_index: int, end_index: int}>}}>, file_ids: array<int, string>|null}}>
 */
final class ThreadMessageDeltaResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{id: string, object: string, delta: array{role: string|null, content: array<int, array{index: int, type: 'image_file', image_file: array{file_id: string}}|array{index: int, type: 'text', text: array{value: ?string, annotations: array<int, array{type: 'file_citation', text: string, file_citation: array{file_id: string, quote?: string}, start_index: int, end_index: int}|array{type: 'file_path', text: string, file_path: array{file_id: string}, start_index: int, end_index: int}>}}>, file_ids: array<int, string>|null}}>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public string $id,
        public string $object,
        public ThreadMessageDeltaObject $delta,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id: string, object: string, delta: array{role?: string, content: array<int, array{index: int, type: 'image_file', image_file: array{file_id: string}}|array{index: int, type: 'text', text: array{value?: string, annotations: array<int, array{type: 'file_citation', text: string, file_citation: array{file_id: string, quote?: string}, start_index: int, end_index: int}|array{type: 'file_path', text: string, file_path: array{file_id: string}, start_index: int, end_index: int}>}}>, file_ids?: array<int, string>}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['object'],
            ThreadMessageDeltaObject::from($attributes['delta'])
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'object' => $this->object,
            'delta' => $this->delta->toArray(),
        ];
    }
}
