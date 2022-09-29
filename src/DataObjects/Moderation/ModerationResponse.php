<?php

namespace OpenAI\DataObjects\Moderation;

use OpenAI\Contracts\DataObject;

final class ModerationResponse implements DataObject
{
    /**
     * @param  array<array-key, ModerationResult>  $results
     */
    public function __construct(
        public readonly string $id,
        public readonly string $model,
        public readonly array $results,
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'model' => $this->model,
            'results' => array_map(fn (ModerationResult $result): array => $result->toArray(), $this->results),
        ];
    }
}
