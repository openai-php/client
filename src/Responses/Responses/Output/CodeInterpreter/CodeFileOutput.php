<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output\CodeInterpreter;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type CodeFileObjectType from CodeFileObject
 *
 * @phpstan-type CodeFileOutputType array{files: array<int, CodeFileObjectType>, type: 'files'}
 *
 * @implements ResponseContract<CodeFileOutputType>
 */
final class CodeFileOutput implements ResponseContract
{
    /**
     * @use ArrayAccessible<CodeFileOutputType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, CodeFileObject>  $files
     * @param  'files'  $type
     */
    private function __construct(
        public readonly array $files,
        public readonly string $type,
    ) {}

    /**
     * @param  CodeFileOutputType  $attributes
     */
    public static function from(array $attributes): self
    {
        $files = array_map(
            static fn (array $file): CodeFileObject => CodeFileObject::from($file),
            $attributes['files']
        );

        return new self(
            files: $files,
            type: $attributes['type'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'files' => array_map(
                static fn (CodeFileObject $file): array => $file->toArray(),
                $this->files
            ),
        ];
    }
}
