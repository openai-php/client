<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output\ApplyPatchOperation;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type OutputApplyPatchOperationDeleteFileType array{type: 'delete_file', path: string}
 *
 * @implements ResponseContract<OutputApplyPatchOperationDeleteFileType>
 */
final class OutputApplyPatchOperationDeleteFile implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputApplyPatchOperationDeleteFileType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'delete_file'  $type
     */
    private function __construct(
        public readonly string $type,
        public readonly string $path,
    ) {}

    /**
     * @param  OutputApplyPatchOperationDeleteFileType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
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
            'path' => $this->path,
        ];
    }
}
