<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type LocalShellToolType array{type: 'local_shell'}
 *
 * @implements ResponseContract<LocalShellToolType>
 */
final class LocalShellTool implements ResponseContract
{
    /**
     * @use ArrayAccessible<LocalShellToolType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'local_shell'  $type
     */
    private function __construct(
        public readonly string $type,
    ) {}

    /**
     * @param  LocalShellToolType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
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
        ];
    }
}
