<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Responses\Output\WebSearch\OutputWebSearchAction;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type WebSearchActionType from OutputWebSearchAction
 * @phpstan-import-type OutputWebSearchToolCallResultType from OutputWebSearchToolCallResult
 *
 * @phpstan-type OutputWebSearchToolCallType array{id: string, status: string, type: 'web_search_call', action?: WebSearchActionType, results?: array<int, OutputWebSearchToolCallResultType>}
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
     * @param  ?array<int, OutputWebSearchToolCallResult>  $results
     */
    private function __construct(
        public readonly string $id,
        public readonly string $status,
        public readonly string $type,
        public readonly ?OutputWebSearchAction $action,
        public readonly ?array $results,
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
                : null,
            results: isset($attributes['results'])
                ? array_map(
                    static fn (array $result): OutputWebSearchToolCallResult => OutputWebSearchToolCallResult::from($result),
                    $attributes['results'],
                )
                : null,
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

        if ($this->results !== null) {
            $data['results'] = array_map(
                static fn (OutputWebSearchToolCallResult $result): array => $result->toArray(),
                $this->results,
            );
        }

        return $data;
    }
}
