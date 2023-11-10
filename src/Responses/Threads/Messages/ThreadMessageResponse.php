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
 * @implements ResponseContract<array{task: ?string, language: ?string, duration: ?float, segments: array<int, array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient: bool}>, text: string}>
 */
final class ThreadMessageResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<array{task: ?string, language: ?string, duration: ?float, segments: array<int, array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient: bool}>, text: string}>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  array<int, ThreadMessageResponseContentTextObject|ThreadMessageResponseContentImageFileObject>  $content
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
     * @param  array{task: ?string, language: ?string, duration: ?float, segments: array<int, array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient: bool}>, text: string}|string  $attributes
     */
    public static function from(array|string $attributes, MetaInformation $meta): self
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
            'assistant_id' => $this->assistantId,
            'run_id' => $this->runId,
            'file_ids' => $this->fileIds,
            'metadata' => $this->metadata,
        ];
    }
}
