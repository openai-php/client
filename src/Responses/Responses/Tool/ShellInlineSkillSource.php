<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Tool;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type ShellInlineSkillSourceType array{type: 'base64', media_type: 'application/zip', data: string}
 *
 * @implements ResponseContract<ShellInlineSkillSourceType>
 */
final class ShellInlineSkillSource implements ResponseContract
{
    /**
     * @use ArrayAccessible<ShellInlineSkillSourceType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'base64'  $type
     * @param  'application/zip'  $mediaType
     */
    private function __construct(
        public readonly string $type,
        public readonly string $mediaType,
        public readonly string $data,
    ) {}

    /**
     * @param  ShellInlineSkillSourceType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
            mediaType: $attributes['media_type'],
            data: $attributes['data'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'media_type' => $this->mediaType,
            'data' => $this->data,
        ];
    }
}
