<?php

declare(strict_types=1);

namespace OpenAI\Responses\Threads\Runs\Steps;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{id: string, type: 'file_search', file_search: array<string, string>}>
 */
final class ThreadRunStepResponseFileSearchToolCall implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{id: string, type: 'file_search', file_search: array<string, string>}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'file_search'  $type
     * @param  array<string, string>  $file_search
     */
    private function __construct(
        public string $id,
        public string $type,
        public array $file_search,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id: string, type: 'file_search', file_search: array<string, string>}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['type'],
            $attributes['file_search'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'file_search' => $this->file_search,
        ];
    }
}
