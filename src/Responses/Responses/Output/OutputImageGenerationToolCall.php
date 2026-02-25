<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type OutputImageGenerationToolCallType array{id: string, result?: string|null, status: string, type: 'image_generation_call', action?: string|null, background?: string|null, output_format?: string|null, quality?: string|null, revised_prompt?: string|null, size?: string|null}
 *
 * @implements ResponseContract<OutputImageGenerationToolCallType>
 */
final class OutputImageGenerationToolCall implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputImageGenerationToolCallType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'image_generation_call'  $type
     */
    private function __construct(
        public readonly string $id,
        public readonly ?string $result,
        public readonly string $status,
        public readonly string $type,
        public readonly ?string $action,
        public readonly ?string $background,
        public readonly ?string $outputFormat,
        public readonly ?string $quality,
        public readonly ?string $revisedPrompt,
        public readonly ?string $size,
    ) {}

    /**
     * @param  OutputImageGenerationToolCallType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            id: $attributes['id'],
            result: $attributes['result'] ?? null,
            status: $attributes['status'],
            type: $attributes['type'],
            action: $attributes['action'] ?? null,
            background: $attributes['background'] ?? null,
            outputFormat: $attributes['output_format'] ?? null,
            quality: $attributes['quality'] ?? null,
            revisedPrompt: $attributes['revised_prompt'] ?? null,
            size: $attributes['size'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'result' => $this->result,
            'status' => $this->status,
            'type' => $this->type,
            'action' => $this->action,
            'background' => $this->background,
            'output_format' => $this->outputFormat,
            'quality' => $this->quality,
            'revised_prompt' => $this->revisedPrompt,
            'size' => $this->size,
        ];
    }
}
