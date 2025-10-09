<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type CreateResponseChoiceImageType array{image_url: array{url: string, detail: string}, index: int, type: string}
 *
 * @implements ResponseContract<CreateResponseChoiceImageType>
 */
final class CreateResponseChoiceImage implements ResponseContract
{
    /**
     * @use ArrayAccessible<CreateResponseChoiceImageType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array{url: string, detail: string}  $imageUrl
     */
    private function __construct(
        public readonly array $imageUrl,
        public readonly int $index,
        public readonly string $type,
    ) {}

    /**
     * @param  CreateResponseChoiceImageType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            imageUrl: $attributes['image_url'],
            index: $attributes['index'],
            type: $attributes['type'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'image_url' => $this->imageUrl,
            'index' => $this->index,
            'type' => $this->type,
        ];
    }
}
