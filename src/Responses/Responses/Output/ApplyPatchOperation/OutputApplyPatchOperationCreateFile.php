<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output\ApplyPatchOperation;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type OutputApplyPatchOperationCreateFileType array{type: 'create_file', diff: string, path: string}
 *
 * @implements ResponseContract<OutputApplyPatchOperationCreateFileType>
 */
final class OutputApplyPatchOperationCreateFile implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputApplyPatchOperationCreateFileType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'create_file'  $type
     */
    private function __construct(
        public readonly string $type,
        public readonly string $diff,
        public readonly string $path,
    ) {}

    /**
     * @param  OutputApplyPatchOperationCreateFileType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
            diff: $attributes['diff'],
            path: $attributes['path'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'diff' => $this->diff,
            'path' => $this->path,
        ];
    }
}
