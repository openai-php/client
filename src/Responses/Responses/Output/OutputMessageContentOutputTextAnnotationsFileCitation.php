<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type FileCitationType array{file_id: string, filename: string, index: int, type: 'file_citation'}
 *
 * @implements ResponseContract<FileCitationType>
 */
final class OutputMessageContentOutputTextAnnotationsFileCitation implements ResponseContract
{
    /**
     * @use ArrayAccessible<FileCitationType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'file_citation'  $type
     */
    private function __construct(
        public readonly string $fileId,
        public readonly string $filename,
        public readonly int $index,
        public readonly string $type,
    ) {}

    /**
     * @param  FileCitationType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            fileId: $attributes['file_id'],
            filename: $attributes['filename'],
            index: $attributes['index'],
            type: $attributes['type'],
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
            'index' => $this->index,
            'type' => $this->type,
        ];
    }
}
