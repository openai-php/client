<?php

declare(strict_types=1);

namespace OpenAI\Responses\Assistants;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<>
 */
final class AssistantResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  array<int, TranscriptionResponseSegment>  $segments
     */
    private function __construct(
        public string $id,
        public string $object,
        public int $createdAt,
        public ?string $name,
        public ?string $description,
        public string $model,
        public ?string $instructions,
        public array $tools,
        public array $fileIds,
        public array $metadata,
        private readonly MetaInformation $meta,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param    $attributes
     */
    public static function from(array|string $attributes, MetaInformation $meta): self
    {
        $tools = array_map(fn (array $result): AssistantToolResponse => AssistantToolResponse::from(
            $result
        ), $attributes['tools']);

        return new self(
            $attributes['id'],
            $attributes['object'],
            $attributes['created_at'],
            $attributes['name'],
            $attributes['description'],
            $attributes['model'],
            $attributes['instructions'],
            $tools,
            $attributes['file_ids'],
            $attributes['metadata'],
            $meta,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'object' => $this->object,
            'created_at' => $this->createdAt,
            'name' => $this->name,
            'description' => $this->description,
            'model' => $this->model,
            'instructions' => $this->instructions,
            'tools' => array_map(fn (AssistantToolResponse $tool): array => $tool->toArray(), $this->tools),
            'file_ids' => $this->fileIds,
            'metadata' => $this->metadata,
        ];
    }
}
