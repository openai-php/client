<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Responses\Output\WebSearch\OutputWebSearchAction;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type WebSearchActionType from OutputWebSearchAction
 *
 * @phpstan-type OutputWebSearchToolCallType array{id: string, status: string, type: 'web_search_call', action?: WebSearchActionType}
 *
 * @implements ResponseContract<OutputWebSearchToolCallType>
 */
final class OutputWebSearchToolCall implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputWebSearchToolCallType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'web_search_call'  $type
     */
    private function __construct(
        public readonly string $id,
        public readonly string $status,
        public readonly string $type,
        public readonly ?OutputWebSearchAction $action,
    ) {}

    /**
     * @param  OutputWebSearchToolCallType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            id: $attributes['id'],
            status: $attributes['status'],
            type: $attributes['type'],
            action: isset($attributes['action'])
                ? OutputWebSearchAction::from($attributes['action'])
                : null
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        $data = [
            'id' => $this->id,
            'status' => $this->status,
            'type' => $this->type,
        ];

        if ($this->action !== null) {
            $data['action'] = $this->action->toArray();
        }

        return $data;
    }
}
