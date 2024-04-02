<?php

declare(strict_types=1);

namespace OpenAI\Responses\Threads\Messages\Delta;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{index: int, type: string, text: array{value: string, annotations: array<int, array{type: string, text: string, file_citation: array{file_id: string, quote: string}, start_index: int, end_index: int}|array{type: string, text: string, file_path: array{file_id: string}, start_index: int, end_index: int}>}}>
 */
final class ThreadMessageDeltaResponseContentTextObject implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{index: int, type: string, text: array{value: string, annotations: array<int, array{type: string, text: string, file_citation: array{file_id: string, quote: string}, start_index: int, end_index: int}|array{type: string, text: string, file_path: array{file_id: string}, start_index: int, end_index: int}>}}>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public ?int $index,
        public string $type,
        public ThreadMessageDeltaResponseContentText $text,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{index: int, type: string, text: array{value: string, annotations: array<int, array{type: 'file_citation', text: string, file_citation: array{file_id: string, quote: string}, start_index: int, end_index: int}|array{type: 'file_path', text: string, file_path: array{file_id: string}, start_index: int, end_index: int}>}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            isset($attributes['index']) ? $attributes['index'] : null,
            $attributes['type'],
            ThreadMessageDeltaResponseContentText::from($attributes['text']),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'index' => $this->index,
            'type' => $this->type,
            'text' => $this->text->toArray(),
        ];
    }
}
