<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{id?: string, object: string, created: int, model: string, system_fingerprint?: string, choices: array<int, array{index: int, message: array{role: string, content: string|null, annotations?: array<int, array{type: string, url_citation: array{start_index: int, end_index: int, title: string, url: string}}>, function_call?: array{name: string, arguments: string}, tool_calls?: array<int, array{id: string, type: string, function: array{name: string, arguments: string}}>}, logprobs: ?array{content: ?array<int, array{token: string, logprob: float, bytes: ?array<int, int>}>}, finish_reason: string|null}>, usage?: array{prompt_tokens: int, completion_tokens: int|null, total_tokens: int}}>
 */
final class CreateResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<array{id: string, object: string, created: int, model: string, system_fingerprint?: string, choices: array<int, array{index: int, message: array{role: string, content: string|null, annotations?: array<int, array{type: string, url_citation: array{start_index: int, end_index: int, title: string, url: string}}>, function_call?: array{name: string, arguments: string}, tool_calls?: array<int, array{id: string, type: string, function: array{name: string, arguments: string}}>}, logprobs: ?array{content: ?array<int, array{token: string, logprob: float, bytes: ?array<int, int>}>}, finish_reason: string|null}>, usage: array{prompt_tokens: int, completion_tokens: int|null, total_tokens: int}}>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  array<int, CreateResponseChoice>  $choices
     */
    private function __construct(
        public readonly ?string $id,
        public readonly string $object,
        public readonly int $created,
        public readonly string $model,
        public readonly ?string $systemFingerprint,
        public readonly array $choices,
        public readonly ?CreateResponseUsage $usage,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id?: string, object: string, created: int, model: string, system_fingerprint?: string, choices: array<int, array{index: int, message: array{role: string, content: ?string, annotations?: array<int, array{type: string, url_citation: array{start_index: int, end_index: int, title: string, url: string}}>, function_call?: array{name: string, arguments: string}, tool_calls?: array<int, array{id: string, type: string, function: array{name: string, arguments: string}}>}, logprobs: ?array{content: ?array<int, array{token: string, logprob: float, bytes: ?array<int, int>}>}, finish_reason: string|null}>, usage?: array{prompt_tokens: int, completion_tokens: int|null, total_tokens: int, prompt_tokens_details?:array{cached_tokens:int}, completion_tokens_details?:array{audio_tokens?:int, reasoning_tokens:int, accepted_prediction_tokens:int, rejected_prediction_tokens:int}}}  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        $choices = array_map(fn (array $result): CreateResponseChoice => CreateResponseChoice::from(
            $result
        ), $attributes['choices']);

        return new self(
            $attributes['id'] ?? null,
            $attributes['object'],
            $attributes['created'],
            $attributes['model'],
            $attributes['system_fingerprint'] ?? null,
            $choices,
            isset($attributes['usage']) ? CreateResponseUsage::from($attributes['usage']) : null,
            $meta,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'object' => $this->object,
            'created' => $this->created,
            'model' => $this->model,
            'system_fingerprint' => $this->systemFingerprint,
            'choices' => array_map(
                static fn (CreateResponseChoice $result): array => $result->toArray(),
                $this->choices,
            ),
            'usage' => $this->usage?->toArray(),
        ], fn (mixed $value): bool => ! is_null($value));
    }
}
