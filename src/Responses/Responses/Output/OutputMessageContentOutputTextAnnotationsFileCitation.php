<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

final class OutputMessageContentOutputTextAnnotationsFileCitation
{
    /**
     * @param  'file_citation'  $type
     */
    private function __construct(
        public readonly string $fileId,
        public readonly int $index,
        public readonly string $type,
    ) {}

    /**
     * @param  array{file_id: string, index: int, type: 'file_citation'}  $attributes
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
     * @return array{file_id: string, index: int, type: 'file_citation'}
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
