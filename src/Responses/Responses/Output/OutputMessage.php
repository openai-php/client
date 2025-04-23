<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type OutputTextType from OutputMessageContentOutputText
 * @phpstan-import-type ContentRefusalType from OutputMessageContentRefusal
 *
 * @phpstan-type OutputMessageType array{content: array<int, OutputTextType|ContentRefusalType>, id: string, role: 'assistant', status: 'in_progress'|'completed'|'incomplete', type: 'message'}
 *
 * @implements ResponseContract<OutputMessageType>
 */
final class OutputMessage implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputMessageType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, OutputMessageContentOutputText|OutputMessageContentRefusal>  $content
     * @param  'assistant'  $role
     * @param  'in_progress'|'completed'|'incomplete'  $status
     * @param  'message'  $type
     */
    private function __construct(
        public readonly array $content,
        public readonly string $id,
        public readonly string $role,
        public readonly string $status,
        public readonly string $type,
    ) {}

    /**
     * @param  OutputMessageType  $attributes
     */
    public static function from(array $attributes): self
    {
        $content = array_map(
            fn (array $item): OutputMessageContentOutputText|OutputMessageContentRefusal => match ($item['type']) {
                'output_text' => OutputMessageContentOutputText::from($item),
                'refusal' => OutputMessageContentRefusal::from($item),
            },
            $attributes['content'],
        );

        return new self(
            content: $content,
            id: $attributes['id'],
            role: $attributes['role'],
            status: $attributes['status'],
            type: $attributes['type'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'content' => array_map(
                fn (OutputMessageContentOutputText|OutputMessageContentRefusal $item): array => $item->toArray(),
                $this->content,
            ),
            'id' => $this->id,
            'role' => $this->role,
            'status' => $this->status,
            'type' => $this->type,
        ];
    }
}
