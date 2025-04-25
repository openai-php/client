<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Input;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type ContentInputFileType array{type: 'input_file', file_data: string, file_id: string, filename: string}
 *
 * @implements ResponseContract<ContentInputFileType>
 */
final class InputMessageContentInputFile implements ResponseContract
{
    /**
     * @use ArrayAccessible<ContentInputFileType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'input_file'  $type
     */
    private function __construct(
        public readonly string $type,
        public readonly string $fileData,
        public readonly string $fileId,
        public readonly string $filename,
    ) {}

    /**
     * @param  ContentInputFileType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
            fileData: $attributes['file_data'],
            fileId: $attributes['file_id'],
            filename: $attributes['filename'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'file_data' => $this->fileData,
            'file_id' => $this->fileId,
            'filename' => $this->filename,
        ];
    }
}
