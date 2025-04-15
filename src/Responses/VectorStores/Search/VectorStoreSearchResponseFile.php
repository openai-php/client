<?php

declare(strict_types=1);

namespace OpenAI\Responses\VectorStores\Search;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{file_id: string, filename: string, score: float, attributes: array<string, mixed>, content: array<int, array{type: string, text: string}>}>
 */
final class VectorStoreSearchResponseFile implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{file_id: string, filename: string, score: float, attributes: array<string, mixed>, content: array<int, array{type: string, text: string}>}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<string, mixed>  $attributes
     * @param  array<int, VectorStoreSearchResponseContent>  $content
     */
    private function __construct(
        public readonly string $fileId,
        public readonly string $filename,
        public readonly float $score,
        public readonly array $attributes,
        public readonly array $content,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{file_id: string, filename: string, score: float, attributes: array<string, mixed>, content: array<int, array{type: string, text: string}>}  $attributes
     */
    public static function from(array $attributes): self
    {
        $content = array_map(
            static fn (array $content): VectorStoreSearchResponseContent => VectorStoreSearchResponseContent::from($content),
            $attributes['content'],
        );

        return new self(
            $attributes['file_id'],
            $attributes['filename'],
            $attributes['score'],
            $attributes['attributes'],
            $content,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'file_id' => $this->fileId,
            'filename' => $this->filename,
            'score' => $this->score,
            'attributes' => $this->attributes,
            'content' => array_map(
                static fn (VectorStoreSearchResponseContent $content): array => $content->toArray(),
                $this->content,
            ),
        ];
    }
}
