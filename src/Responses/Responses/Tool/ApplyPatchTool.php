<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type ApplyPatchToolType array{type: 'apply_patch', allowed_callers?: array<int, 'direct'|'programmatic'>|null}
 *
 * @implements ResponseContract<ApplyPatchToolType>
 */
final class ApplyPatchTool implements ResponseContract
{
    /**
     * @use ArrayAccessible<ApplyPatchToolType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'apply_patch'  $type
     * @param  array<int, 'direct'|'programmatic'>|null  $allowedCallers
     */
    private function __construct(
        public readonly string $type,
        public readonly ?array $allowedCallers,
    ) {}

    /**
     * @param  ApplyPatchToolType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
            allowedCallers: $attributes['allowed_callers'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'allowed_callers' => $this->allowedCallers,
        ];
    }
}
