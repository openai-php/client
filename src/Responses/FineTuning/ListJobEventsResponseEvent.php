<?php

declare(strict_types=1);

namespace OpenAI\Responses\FineTuning;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Enums\FineTuning\FineTuningEventLevel;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array{object: string, id: string, created_at: int, level: string, message: string, data: array{step: int, train_loss: float, train_mean_token_accuracy: float}|null, type: string}>
 */
final class ListJobEventsResponseEvent implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{object: string, id: string, created_at: int, level: string, message: string, data: array{step: int, train_loss: float, train_mean_token_accuracy: float}|null, type: string}>
     */
    use ArrayAccessible;

    private function __construct(
        public readonly string $object,
        public readonly string $id,
        public readonly int $createdAt,
        public readonly FineTuningEventLevel $level,
        public readonly string $message,
        public readonly ?ListJobEventsResponseEventData $data,
        public readonly string $type,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{object: string, id: string, created_at: int, level: string, message: string, data: array{step: int, train_loss: float, train_mean_token_accuracy: float}|null, type: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['object'],
            $attributes['id'],
            $attributes['created_at'],
            FineTuningEventLevel::from($attributes['level']),
            $attributes['message'],
            $attributes['data'] ? ListJobEventsResponseEventData::from($attributes['data']) : null,
            $attributes['type'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'object' => $this->object,
            'id' => $this->id,
            'created_at' => $this->createdAt,
            'level' => $this->level->value,
            'message' => $this->message,
            'data' => $this->data?->toArray(),
            'type' => $this->type,
        ];
    }
}
