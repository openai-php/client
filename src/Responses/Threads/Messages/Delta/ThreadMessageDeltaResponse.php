<?php

declare(strict_types=1);

namespace OpenAI\Responses\Threads\Messages\Delta;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{id: string, object: string, created_at: int, thread_id: string, role: string, content: array<int, array{type: string, image_file: array{file_id: string}}|array{type: string, text: array{value: string, annotations: array<int, array{type: string, text: string, file_citation: array{file_id: string, quote: string}, start_index: int, end_index: int}|array{type: string, text: string, file_path: array{file_id: string}, start_index: int, end_index: int}>}}>, assistant_id: ?string, run_id: ?string, file_ids: array<int, string>, metadata: array<string, string>}>
 */
final class ThreadMessageDeltaResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{id: string, object: string, created_at: int, thread_id: string, role: string, content: array<int, array{type: string, image_file: array{file_id: string}}|array{type: string, text: array{value: string, annotations: array<int, array{type: string, text: string, file_citation: array{file_id: string, quote: string}, start_index: int, end_index: int}|array{type: string, text: string, file_path: array{file_id: string}, start_index: int, end_index: int}>}}>, assistant_id: ?string, run_id: ?string, file_ids: array<int, string>, metadata: array<string, string>}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, ThreadMessageResponseContentImageFileObject|ThreadMessageDeltaResponseContentTextObject>  $content
     * @param  array<int, string>  $fileIds
     */
    private function __construct(
        public string $id,
        public string $object,
        public ?string $role,
        public array $content,
        public ?array $fileIds,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id: string, object: string, created_at: int, thread_id: string, role: string, content: array<int, array{type: 'image_file', image_file: array{file_id: string}}|array{type: 'text', text: array{value: string, annotations: array<int, array{type: 'file_citation', text: string, file_citation: array{file_id: string, quote: string}, start_index: int, end_index: int}|array{type: 'file_path', text: string, file_path: array{file_id: string}, start_index: int, end_index: int}>}}>, assistant_id: ?string, run_id: ?string, file_ids: array<int, string>, metadata: array<string, string>}  $attributes
     */
    public static function from(array $attributes): self
    {
        $content = array_map(
            fn (array $content): \OpenAI\Responses\Threads\Messages\Delta\ThreadMessageDeltaResponseContentTextObject|\OpenAI\Responses\Threads\Messages\Delta\ThreadMessageDeltaResponseContentImageFileObject => match ($content['type']) {
                'text' => ThreadMessageDeltaResponseContentTextObject::from($content),
                'image_file' => ThreadMessageDeltaResponseContentImageFileObject::from($content),
            },
            $attributes['delta']['content'],
        );

        return new self(
            $attributes['id'],
            $attributes['object'],
            isset($attributes['delta']['role']) ? $attributes['delta']['role'] : null,
            $content,
            isset($attributes['delta']['file_ids']) ? $attributes['delta']['file_ids'] : null,
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
            'role' => $this->role,
            'content' => array_map(
                fn (ThreadMessageResponseContentImageFileObject|ThreadMessageDeltaResponseContentTextObject $content): array => $content->toArray(),
                $this->content,
            ),
            'file_ids' => $this->fileIds,
        ];
    }
}
