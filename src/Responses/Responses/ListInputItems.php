<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Responses\Input\InputMessageContentInputFile;
use OpenAI\Responses\Responses\Input\InputMessageContentInputImage;
use OpenAI\Responses\Responses\Input\InputMessageContentInputText;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{object: string, data: array<int, array{type: string, id: string, status: string, role: string, content: array<int, array{type: 'input_text', text: string}|array{type: 'input_image', detail: string, file_id: string|null, image_url: string|null}|array{type: 'input_file', file_data: string, file_id: string, filename: string}>}>, first_id: string, last_id: string, has_more: bool}>
 */
final class ListInputItems implements ResponseContract, ResponseHasMetaInformationContract
{
    /** @use ArrayAccessible<array{object: string, data: array<int, array{type: string, id: string, status: string, role: string, content: array<int, array{type: 'input_text', text: string}|array{type: 'input_image', detail: string, file_id: string|null, image_url: string|null}|array{type: 'input_file', file_data: string, file_id: string, filename: string}>}>, first_id: string, last_id: string, has_more: bool}> */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param array<int, array{
     *   type: string,
     *   id: string,
     *   status: string,
     *   role: string,
     *   content: array<int, InputMessageContentInputText|InputMessageContentInputImage|InputMessageContentInputFile>
     * }> $data
     */
    private function __construct(
        public readonly string $object,
        public readonly array $data,
        public readonly string $firstId,
        public readonly string $lastId,
        public readonly bool $hasMore,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{object: string, data: array<int, array{type: string, id: string, status: string, role: string, content: array<int, array{type: 'input_text', text: string}|array{type: 'input_image', detail: string, file_id: string|null, image_url: string|null}|array{type: 'input_file', file_data: string, file_id: string, filename: string}>}>, first_id: string, last_id: string, has_more: bool}  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        $data = array_map(
            function (array $item): array {
                $content = array_map(
                    fn (array $contentItem): InputMessageContentInputText|InputMessageContentInputImage|InputMessageContentInputFile => match ($contentItem['type']) {
                        'input_text' => InputMessageContentInputText::from($contentItem),
                        'input_image' => InputMessageContentInputImage::from($contentItem),
                        'input_file' => InputMessageContentInputFile::from($contentItem),
                    },
                    $item['content'],
                );

                return [
                    'type' => $item['type'],
                    'id' => $item['id'],
                    'status' => $item['status'],
                    'role' => $item['role'],
                    'content' => $content,
                ];
            },
            $attributes['data'],
        );

        return new self(
            object: $attributes['object'],
            data: $data,
            firstId: $attributes['first_id'],
            lastId: $attributes['last_id'],
            hasMore: $attributes['has_more'],
            meta: $meta,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'object' => $this->object,
            'data' => $this->data,
            'first_id' => $this->firstId,
            'last_id' => $this->lastId,
            'has_more' => $this->hasMore,
        ];
    }
}
