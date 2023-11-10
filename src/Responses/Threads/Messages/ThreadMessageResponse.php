<?php

declare(strict_types=1);

namespace OpenAI\Responses\Threads\Messages;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{id: string, object: string, created_at: int, thread_id: string, role: string, content: array<int, array{type: string, image_file: array{file_id: string}}|array{type: string, text: array{value: string, annotations: array<int, array{type: string, text: string, file_citation: array{file_id: string, quote: string}, start_index: int, end_index: int}|array{type: string, text: string, file_path: array{file_id: string}, start_index: int, end_index: int}>}}>, assistant_id: ?string, run_id: ?string, file_ids: array<int, string>, metadata: array<string, string>}>
 */
final class ThreadMessageResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<array{id: string, object: string, created_at: int, thread_id: string, role: string, content: array<int, array{type: string, image_file: array{file_id: string}}|array{type: string, text: array{value: string, annotations: array<int, array{type: string, text: string, file_citation: array{file_id: string, quote: string}, start_index: int, end_index: int}|array{type: string, text: string, file_path: array{file_id: string}, start_index: int, end_index: int}>}}>, assistant_id: ?string, run_id: ?string, file_ids: array<int, string>, metadata: array<string, string>}>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  array<int, ThreadMessageResponseContentImageFileObject|ThreadMessageResponseContentTextObject>  $content
     * @param  array<int, string>  $fileIds
     * @param  array<string, string>  $metadata
     */
    private function __construct(
        public string $id,
        public string $object,
        public int $createdAt,
        public string $threadId,
        public string $role,
        public array $content,
        public ?string $assistantId,
        public ?string $runId,
        public array $fileIds,
        public array $metadata,
        private readonly MetaInformation $meta,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id: string, object: string, created_at: int, thread_id: string, role: string, content: array<int, array{type: 'image_file', image_file: array{file_id: string}}|array{type: 'text', text: array{value: string, annotations: array<int, array{type: 'file_citation', text: string, file_citation: array{file_id: string, quote: string}, start_index: int, end_index: int}|array{type: 'file_path', text: string, file_path: array{file_id: string}, start_index: int, end_index: int}>}}>, assistant_id: ?string, run_id: ?string, file_ids: array<int, string>, metadata: array<string, string>}  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        $content = array_map(
            fn (array $content): \OpenAI\Responses\Threads\Messages\ThreadMessageResponseContentTextObject|\OpenAI\Responses\Threads\Messages\ThreadMessageResponseContentImageFileObject => match ($content['type']) {
                'text' => ThreadMessageResponseContentTextObject::from($content),
                'image_file' => ThreadMessageResponseContentImageFileObject::from($content),
            },
            $attributes['content'],
        );

        return new self(
            $attributes['id'],
            $attributes['object'],
            $attributes['created_at'],
            $attributes['thread_id'],
            $attributes['role'],
            $content,
            $attributes['assistant_id'],
            $attributes['run_id'],
            $attributes['file_ids'],
            $attributes['metadata'],
            $meta,
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
            'created_at' => $this->createdAt,
            'thread_id' => $this->threadId,
            'role' => $this->role,
            'content' => array_map(
                fn (ThreadMessageResponseContentImageFileObject|ThreadMessageResponseContentTextObject $content): array => $content->toArray(),
                $this->content,
            ),
            'file_ids' => $this->fileIds,
            'assistant_id' => $this->assistantId,
            'run_id' => $this->runId,
            'metadata' => $this->metadata,
        ];
    }
}
