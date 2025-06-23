<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type ContainerFileType array{file_id: string, type: 'container_file_citation', text?: string, start_index?: int, end_index?: int}
 *
 * @implements ResponseContract<ContainerFileType>
 */
final class OutputMessageContentOutputTextAnnotationsContainerFile implements ResponseContract
{
    /**
     * @use ArrayAccessible<ContainerFileType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'container_file_citation'  $type
     */
    private function __construct(
        public readonly string $fileId,
        public readonly string $type,
        public readonly ?string $text,
        public readonly ?int $startIndex,
        public readonly ?int $endIndex,
    ) {}

    /**
     * @param  ContainerFileType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            fileId: $attributes['file_id'],
            type: $attributes['type'],
            text: $attributes['text'] ?? null,
            startIndex: $attributes['start_index'] ?? null,
            endIndex: $attributes['end_index'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        $result = [
            'file_id' => $this->fileId,
            'type' => $this->type,
        ];

        if ($this->text !== null) {
            $result['text'] = $this->text;
        }

        if ($this->startIndex !== null) {
            $result['start_index'] = $this->startIndex;
        }

        if ($this->endIndex !== null) {
            $result['end_index'] = $this->endIndex;
        }

        return $result;
    }
}
