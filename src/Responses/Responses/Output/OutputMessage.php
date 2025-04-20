<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{content: array<int, array{annotations: array<int, array{file_id: string, index: int, type: 'file_citation'}|array{file_id: string, index: int, type: 'file_path'}|array{end_index: int, start_index: int, title: string, type: 'url_citation', url: string}>, text: string, type: 'output_text'}|array{refusal: string, type: 'refusal'}>, id: string, role: string, status: 'in_progress'|'completed'|'incomplete', type: 'message'}>
 */
final class OutputMessage implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{content: array<int, array{annotations: array<int, array{file_id: string, index: int, type: 'file_citation'}|array{file_id: string, index: int, type: 'file_path'}|array{end_index: int, start_index: int, title: string, type: 'url_citation', url: string}>, text: string, type: 'output_text'}|array{refusal: string, type: 'refusal'}>, id: string, role: string, status: 'in_progress'|'completed'|'incomplete', type: 'message'}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, OutputMessageContentOutputText|OutputMessageContentRefusal>  $content
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
     * @param  array{content: array<int, array{annotations: array<int, array{file_id: string, index: int, type: 'file_citation'}|array{file_id: string, index: int, type: 'file_path'}|array{end_index: int, start_index: int, title: string, type: 'url_citation', url: string}>, text: string, type: 'output_text'}|array{refusal: string, type: 'refusal'}>, id: string, role: string, status: 'in_progress'|'completed'|'incomplete', type: 'message'}  $attributes
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
