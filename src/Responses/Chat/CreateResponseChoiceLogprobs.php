<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

/**
 * @phpstan-type LogprobContentType array{token: string, logprob: float, bytes: ?array<int, int>, top_logprobs?: array<int, array{token: string, logprob: float, bytes: ?array<int, int>}>}
 */
final class CreateResponseChoiceLogprobs
{
    /**
     * @param  ?array<int, CreateResponseChoiceLogprobsContent>  $content
     * @param  ?array<int, CreateResponseChoiceLogprobsContent>  $refusal
     */
    private function __construct(
        public readonly ?array $content,
        public readonly ?array $refusal = null,
    ) {}

    /**
     * @param  array{content: ?array<int, LogprobContentType>, refusal?: ?array<int, LogprobContentType>}  $attributes
     */
    public static function from(array $attributes): self
    {
        $content = null;
        if (isset($attributes['content'])) {
            $content = array_map(fn (array $result): CreateResponseChoiceLogprobsContent => CreateResponseChoiceLogprobsContent::from(
                $result
            ), $attributes['content']);
        }

        $refusal = null;
        if (isset($attributes['refusal'])) {
            $refusal = array_map(fn (array $result): CreateResponseChoiceLogprobsContent => CreateResponseChoiceLogprobsContent::from(
                $result
            ), $attributes['refusal']);
        }

        return new self(
            $content,
            $refusal,
        );
    }

    /**
     * @return array{content: ?array<int, array{token: string, logprob: float, bytes: ?array<int, int>, top_logprobs: array<int, array{token: string, logprob: float, bytes: ?array<int, int>}>}>, refusal: ?array<int, array{token: string, logprob: float, bytes: ?array<int, int>, top_logprobs: array<int, array{token: string, logprob: float, bytes: ?array<int, int>}>}>}
     */
    public function toArray(): array
    {
        return [
            'content' => $this->content ? array_map(
                static fn (CreateResponseChoiceLogprobsContent $result): array => $result->toArray(),
                $this->content,
            ) : null,
            'refusal' => $this->refusal ? array_map(
                static fn (CreateResponseChoiceLogprobsContent $result): array => $result->toArray(),
                $this->refusal,
            ) : null,
        ];
    }
}
