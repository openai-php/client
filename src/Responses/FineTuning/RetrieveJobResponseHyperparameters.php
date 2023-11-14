<?php

declare(strict_types=1);

namespace OpenAI\Responses\FineTuning;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array{n_epochs: int|string, batch_size: int|string|null, learning_rate_multiplier: float|string|null}>
 */
final class RetrieveJobResponseHyperparameters implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{n_epochs: int|string, batch_size: int|string|null, learning_rate_multiplier: float|string|null}>
     */
    use ArrayAccessible;

    private function __construct(
        public readonly int|string $nEpochs,
        public readonly int|string|null $batchSize,
        public readonly float|string|null $learningRateMultiplier,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{n_epochs: int|string, batch_size: int|string|null, learning_rate_multiplier: float|string|null}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['n_epochs'],
            $attributes['batch_size'],
            $attributes['learning_rate_multiplier'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'n_epochs' => $this->nEpochs,
            'batch_size' => $this->batchSize,
            'learning_rate_multiplier' => $this->learningRateMultiplier,
        ];
    }
}
