<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @phpstan-type ListMessagesResponseContentPartType array{type: string, text?: ?string, image_url?: ?array{url: string, detail?: ?string}, input_audio?: ?array{data: string, format: string}, file?: ?array{file_data?: ?string, file_id?: ?string, filename?: ?string}}
 *
 * @implements ResponseContract<ListMessagesResponseContentPartType>
 */
final class ListMessagesResponseContentPart implements ResponseContract
{
    /**
     * @use ArrayAccessible<ListMessagesResponseContentPartType>
     */
    use ArrayAccessible;

    /**
     * @param  array{url: string, detail?: ?string}|null  $imageUrl
     * @param  array{data: string, format: string}|null  $inputAudio
     * @param  array{file_data?: ?string, file_id?: ?string, filename?: ?string}|null  $file
     */
    private function __construct(
        public readonly string $type,
        public readonly ?string $text,
        public readonly ?array $imageUrl,
        public readonly ?array $inputAudio,
        public readonly ?array $file,
    ) {}

    /**
     * @param  ListMessagesResponseContentPartType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
            text: $attributes['text'] ?? null,
            imageUrl: $attributes['image_url'] ?? null,
            inputAudio: $attributes['input_audio'] ?? null,
            file: $attributes['file'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return array_filter([
            'type' => $this->type,
            'text' => $this->text,
            'image_url' => $this->imageUrl,
            'input_audio' => $this->inputAudio,
            'file' => $this->file,
        ], fn (mixed $value): bool => ! is_null($value));
    }
}
