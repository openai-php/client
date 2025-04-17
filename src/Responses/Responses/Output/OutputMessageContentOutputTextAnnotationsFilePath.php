<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{file_id: string, index: int, type: 'file_path'}>
 */
final class OutputMessageContentOutputTextAnnotationsFilePath implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{file_id: string, index: int, type: 'file_path'}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'file_path'  $type
     */
    private function __construct(
        public readonly string $fileId,
        public readonly int $index,
        public readonly string $type,
    ) {}

    /**
     * @param  array{file_id: string, index: int, type: 'file_path'}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            fileId: $attributes['file_id'],
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
            'index' => $this->index,
            'type' => $this->type,
        ];
    }
}
