<?php

declare(strict_types=1);

namespace OpenAI\Requests\Completions;

use OpenAI\Contracts\Request;

final class CreateCompletionRequest implements Request
{
    /**
     * @param  null|string|array<int, string|int|array<int, int>>  $prompt
     * @param  null|string|array<int, string>  $stop
     * @param float[]|null $logitBias
     */
    public function __construct(
        public string $model,
        public null|string|array $prompt = null,
        public string|null $suffix = null,
        public ?int $maxTokens = null,
        public ?float $temperature = null,
        public ?float $topP = null,
        public ?int $n = null,
        public ?bool $stream = null,
        public ?int $logprobs = null,
        public ?bool $echo = null,
        public string|array|null $stop = null,
        public ?float $presencePenalty = null,
        public ?float $frequencyPenalty = null,
        public ?int $bestOf = null,
        public ?array $logitBias = null,
        public ?string $user = null,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Request instance.
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['model'],
            $attributes['prompt'] ?? null,
            $attributes['suffix'] ?? null,
            $attributes['max_tokens'] ?? null,
            $attributes['temperature'] ?? null,
            $attributes['top_p'] ?? null,
            $attributes['n'] ?? null,
            $attributes['stream'] ?? null,
            $attributes['logprobs'] ?? null,
            $attributes['echo'] ?? null,
            $attributes['stop'] ?? null,
            $attributes['presence_penalty'] ?? null,
            $attributes['frequency_penalty'] ?? null,
            $attributes['best_of'] ?? null,
            $attributes['logit_bias'] ?? null,
            $attributes['user'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'model' => $this->model,
            'prompt' => $this->prompt,
            'suffix' => $this->suffix,
            'max_tokens' => $this->maxTokens,
            'temperature' => $this->temperature,
            'top_p' => $this->topP,
            'n' => $this->n,
            'stream' => $this->stream,
            'logprobs' => $this->logprobs,
            'echo' => $this->echo,
            'stop' => $this->stop,
            'presence_penalty' => $this->presencePenalty,
            'frequency_penalty' => $this->frequencyPenalty,
            'best_of' => $this->bestOf,
            'logit_bias' => $this->logitBias,
            'user' => $this->user,
        ], fn ($value): bool => $value !== null);
    }
}
