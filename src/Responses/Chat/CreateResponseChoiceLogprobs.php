<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

final class CreateResponseChoiceLogprobs
{
    /**
     * @param  ?array<int, CreateResponseChoiceLogprobsContent>  $content
     */
    private function __construct(
        public readonly ?array $content,
    ) {}

    /**
     * @param  array{content: ?array<int, array{token: string, logprob: float, bytes: ?array<int, int>}>}  $attributes
     */
    public static function from(array $attributes): self
    {
        $content = null;
        if (isset($attributes['content'])) {
            $content = array_map(fn (array $result): CreateResponseChoiceLogprobsContent => CreateResponseChoiceLogprobsContent::from(
                $result
            ), $attributes['content']);
        }

        return new self(
            $content,
        );
    }

    /**
     * @return array{content: ?array<int, array{token: string, logprob: float, bytes: ?array<int, int>}>}
     */
    public function toArray(): array
    {
        return [
            'content' => $this->content ? array_map(
                static fn (CreateResponseChoiceLogprobsContent $result): array => $result->toArray(),
                $this->content,
            ) : null,
        ];
    }
}
