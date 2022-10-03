<?php

namespace OpenAI\Responses\Moderations;

use OpenAI\Contracts\Response;

final class CreateResponse implements Response
{
    /**
     * @param  array<array-key, CreateResponseModerationResult>  $results
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
            'results' => array_map(fn (CreateResponseModerationResult $result): array => $result->toArray(), $this->results),
        ];
    }
}
