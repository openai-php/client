<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

final class OutputMessageContentOutputTextAnnotationsFilePath
{
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
            $attributes['file_id'],
            $attributes['index'],
            $attributes['type'],
        );
    }

    /**
     * @return array{file_id: string, index: int, type: 'file_path'}
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
