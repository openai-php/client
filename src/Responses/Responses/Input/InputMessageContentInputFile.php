<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Input;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{type: 'input_file', file_data: string, file_id: string, filename: string}>
 */
final class InputMessageContentInputFile implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{type: 'input_file', file_data: string, file_id: string, filename: string}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param 'input_file' $type
     * @param string $file_data
     * @param string $file_id
     * @param string $filename
     */
    private function __construct(
        public readonly string $type,
        public readonly string $file_data,
        public readonly string $file_id,
        public readonly string $filename,
    ) {}

    /**
     * @param array{type: 'input_file', file_data: string, file_id: string, filename: string} $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
            file_data: $attributes['file_data'],
            file_id: $attributes['file_id'],
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
            'file_data' => $this->file_data,
            'file_id' => $this->file_id,
            'filename' => $this->filename,
        ];
    }
}