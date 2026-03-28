<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Input;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type FunctionToolCallOutputFileType array{type: 'input_file', file_data?: string, file_id?: string, file_url?: string, filename?: string}
 *
 * @implements ResponseContract<FunctionToolCallOutputFileType>
 */
final class FunctionToolCallOutputFile implements ResponseContract
{
    /**
     * @use ArrayAccessible<FunctionToolCallOutputFileType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'input_file'  $type
     */
    private function __construct(
        public readonly string $type,
        public readonly ?string $fileData,
        public readonly ?string $fileId,
        public readonly ?string $fileUrl,
        public readonly ?string $filename,
    ) {}

    /**
     * @param  FunctionToolCallOutputFileType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
            fileData: $attributes['file_data'] ?? null,
            fileId: $attributes['file_id'] ?? null,
            fileUrl: $attributes['file_url'] ?? null,
            filename: $attributes['filename'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return array_filter([
            'type' => $this->type,
            'file_data' => $this->fileData,
            'file_id' => $this->fileId,
            'file_url' => $this->fileUrl,
            'filename' => $this->filename,
        ], fn ($value) => $value !== null);
    }
}
