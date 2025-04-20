<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Input;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{
 *   content: array<int, array{
 *     type: 'input_text', text: string
 *   }|array{
 *     type: 'input_image', detail: string, file_id: string, image_url: string|null
 *   }|array{
 *     type: 'input_file', file_data: string, file_id: string, filename: string
 *   }>,
 *   id: string,
 *   role: string,
 *   status: 'in_progress'|'completed'|'incomplete',
 *   type: 'message'
 * }>
 */
final class InputMessage implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{
     *   content: array<int, array{
     *     type: 'input_text', text: string
     *   }|array{
     *     type: 'input_image', detail: string, file_id: string, image_url: string|null
     *   }|array{
     *     type: 'input_file', file_data: string, file_id: string, filename: string
     *   }>,
     *   id: string,
     *   role: string,
     *   status: 'in_progress'|'completed'|'incomplete',
     *   type: 'message'
     * }>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, InputMessageContentInputText|InputMessageContentInputImage|InputMessageContentInputFile>  $content
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
     * @param  array{
     *   content: array<int, array{
     *     type: 'input_text', text: string
     *   }|array{
     *     type: 'input_image', detail: string, file_id: string, image_url: string|null
     *   }|array{
     *     type: 'input_file', file_data: string, file_id: string, filename: string
     *   }>,
     *   id: string,
     *   role: string,
     *   status: 'in_progress'|'completed'|'incomplete',
     *   type: 'message'
     * } $attributes
     */
    public static function from(array $attributes): self
    {
        $content = array_map(
            fn (array $item): InputMessageContentInputText|InputMessageContentInputImage|InputMessageContentInputFile => match ($item['type']) {
                'input_text' => InputMessageContentInputText::from($item),
                'input_image' => InputMessageContentInputImage::from($item),
                'input_file' => InputMessageContentInputFile::from($item),
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
                fn (InputMessageContentInputText|InputMessageContentInputImage|InputMessageContentInputFile $item): array => $item->toArray(),
                $this->content,
            ),
            'id' => $this->id,
            'role' => $this->role,
            'status' => $this->status,
            'type' => $this->type,
        ];
    }
}
