<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type OutputFileSearchToolCallResultType array{attributes: array<string, string>, file_id: string, filename: string, score: float, text: string}
 *
 * @implements ResponseContract<OutputFileSearchToolCallResultType>
 */
final class OutputFileSearchToolCallResult implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputFileSearchToolCallResultType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<string, string>  $attributes
     */
    private function __construct(
        public readonly array $attributes,
        public readonly string $fileId,
        public readonly string $filename,
        public readonly float $score,
        public readonly string $text,
    ) {}

    /**
     * @param  OutputFileSearchToolCallResultType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            attributes: $attributes['attributes'],
            fileId: $attributes['file_id'],
            filename: $attributes['filename'],
            score: $attributes['score'],
            text: $attributes['text'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'attributes' => $this->attributes,
            'file_id' => $this->fileId,
            'filename' => $this->filename,
            'score' => $this->score,
            'text' => $this->text,
        ];
    }
}
