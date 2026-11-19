<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

final class CreateResponseChoiceLogprobsContent
{
    /**
     * @param  ?array<int, int>  $bytes
     * @param  array<int, array{token: string, logprob: float, bytes: ?array<int, int>}>  $topLogprobs
     */
    private function __construct(
        public readonly string $token,
        public readonly float $logprob,
        public readonly ?array $bytes,
        public readonly array $topLogprobs = [],
    ) {}

    /**
     * @param array{
     *     token: string,
     *     logprob: float,
     *     bytes: ?array<int, int>,
     *     top_logprobs?: array<int, array{token: string, logprob: float, bytes: ?array<int, int>}>
     * } $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['token'],
            $attributes['logprob'],
            $attributes['bytes'],
            $attributes['top_logprobs'] ?? [],
        );
    }

    /**
     * @return array{
     *     token: string,
     *     logprob: float,
     *     bytes: ?array<int, int>,
     *     top_logprobs: array<int, array{token: string, logprob: float, bytes: ?array<int, int>}>
     * }
     */
    public function toArray(): array
    {
        return [
            'token' => $this->token,
            'logprob' => $this->logprob,
            'bytes' => $this->bytes,
            'top_logprobs' => $this->topLogprobs,
        ];
    }
}
