<?php

declare(strict_types=1);

namespace OpenAI\Requests\Completions;

use OpenAI\Contracts\Request;

/**
 * @implements Request<array{model: string, prompt?: string|array<int, string|int|array<int, int>>, suffix?: string, max_tokens?: int, temperature?: float, top_p?: float, n?: int, stream?: bool, logprobs?: int, echo?: bool, stop?: string|array<int, string>, presence_penalty?: float, frequency_penalty?: float, best_of?: int, logit_bias?: string|array<string, float>, user?: string}>
 */
final class CreateCompletionRequest implements Request
{
    /**
     * @param  null|string|array<int, string|int|array<int, int>>  $prompt
     * @param  null|string|array<int, string>  $stop
     * @param  null|array<string, float>  $logitBias
     */
    public function __construct(
        public string $model,
        public null|string|array $prompt = null,
        public ?string $suffix = null,
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
        public string|array|null $logitBias = null,
        public ?string $user = null,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Request instance.
     *
     * @param  array{model: string, prompt?: null|string|array<int, string|int|array<int, int>>, suffix: ?string, max_tokens: ?int, temperature: ?float, top_p: ?float, n: ?int, stream: ?bool, logprobs: ?int, echo: ?bool, stop: null|string|array<int, string>, presence_penalty: ?float, frequency_penalty: ?float, best_of: ?int, logit_bias: null|string|array<string, float>, user: ?string}  $attributes
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

    /**
     * {@inheritDoc}
     */
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
            'logit_bias' => is_array($this->logitBias) ? json_encode($this->logitBias, JSON_THROW_ON_ERROR) : $this->logitBias,
            'user' => $this->user,
        ], fn ($value): bool => $value !== null);
    }
}
