<?php

declare(strict_types=1);

namespace OpenAI\Responses\FineTuning;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array{step: int, train_loss: float, train_mean_token_accuracy: float}>
 */
final class ListJobEventsResponseEventData implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{step: int, train_loss: float, train_mean_token_accuracy: float}>
     */
    use ArrayAccessible;

    private function __construct(
        public readonly int $step,
        public readonly float $trainLoss,
        public readonly float $trainMeanTokenAccuracy,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{step: int, train_loss: float, train_mean_token_accuracy: float}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['step'],
            $attributes['train_loss'],
            $attributes['train_mean_token_accuracy'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'step' => $this->step,
            'train_loss' => $this->trainLoss,
            'train_mean_token_accuracy' => $this->trainMeanTokenAccuracy,
        ];
    }
}
