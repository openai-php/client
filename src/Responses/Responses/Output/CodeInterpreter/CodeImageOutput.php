<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output\CodeInterpreter;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type CodeImageOutputType array{type: 'image', url: string}
 *
 * @implements ResponseContract<CodeImageOutputType>
 */
final class CodeImageOutput implements ResponseContract
{
    /**
     * @use ArrayAccessible<CodeImageOutputType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'image'  $type
     */
    private function __construct(
        public readonly string $type,
        public readonly string $url,
    ) {}

    /**
     * @param  CodeImageOutputType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
            url: $attributes['url'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'url' => $this->url,
        ];
    }
}
