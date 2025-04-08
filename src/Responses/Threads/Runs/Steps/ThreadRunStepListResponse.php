<?php

declare(strict_types=1);

namespace OpenAI\Responses\Threads\Runs\Steps;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{object: string, data: array<int, array{id: string, object: string, created_at: int, thread_id: string, assistant_id: string, run_id: string, type: string, status: string, step_details: array{type: 'tool_calls', tool_calls: array<int, array{id: ?string, type: 'code_interpreter', code_interpreter: array{input?: string, outputs?: array<int, array{type: 'image', image: array{file_id: string}}|array{type: 'logs', logs: string}>}}|array{id: string, type: 'file_search', file_search: array<string, string>}|array{id: ?string, type: 'function', function: array{name: ?string, arguments: string, output: ?string}}>}|array{type: 'message_creation', message_creation: array{message_id: string}}, last_error: ?array{code: string, message: string}, expires_at: ?int, cancelled_at: ?int, failed_at: ?int, completed_at: ?int, metadata?: array<string, string>, usage: ?array{prompt_tokens: int, completion_tokens: int, total_tokens: int}}>, first_id: ?string, last_id: ?string, has_more: bool}>
 */
final class ThreadRunStepListResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<array{object: string, data: array<int, array{id: string, object: string, created_at: int, thread_id: string, assistant_id: string, run_id: string, type: string, status: string, step_details: array{type: 'tool_calls', tool_calls: array<int, array{id: ?string, type: 'code_interpreter', code_interpreter: array{input?: string, outputs?: array<int, array{type: 'image', image: array{file_id: string}}|array{type: 'logs', logs: string}>}}|array{id: string, type: 'file_search', file_search: array<string, string>}|array{id: ?string, type: 'function', function: array{name: ?string, arguments: string, output: ?string}}>}|array{type: 'message_creation', message_creation: array{message_id: string}}, last_error: ?array{code: string, message: string}, expires_at: ?int, cancelled_at: ?int, failed_at: ?int, completed_at: ?int, metadata?: array<string, string>, usage: ?array{prompt_tokens: int, completion_tokens: int, total_tokens: int}}>, first_id: ?string, last_id: ?string, has_more: bool}>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  array<int, ThreadRunStepResponse>  $data
     */
    private function __construct(
        public readonly string $object,
        public readonly array $data,
        public readonly ?string $firstId,
        public readonly ?string $lastId,
        public readonly bool $hasMore,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{object: string, data: array<int, array{id: string, object: string, created_at: int, thread_id: string, assistant_id: string, run_id: string, type: string, status: string, step_details: array{type: 'tool_calls', tool_calls: array<int, array{id?: string, type: 'code_interpreter', code_interpreter: array{input: string, outputs: array<int, array{type: 'image', image: array{file_id: string}}|array{type: 'logs', logs: string}>}}|array{id: string, type: 'file_search', file_search: array<string, string>}|array{id?: string, type: 'function', function: array{name?: string, arguments: string, output?: ?string}}>}|array{type: 'message_creation', message_creation: array{message_id: string}}, last_error: ?array{code: string, message: string}, expires_at: ?int, cancelled_at: ?int, failed_at: ?int, completed_at: ?int, metadata?: array<string, string>, usage: ?array{prompt_tokens: int, completion_tokens: int, total_tokens: int}}>, first_id: ?string, last_id: ?string, has_more: bool}  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        $data = array_map(fn (array $result): ThreadRunStepResponse => ThreadRunStepResponse::from(
            $result,
            $meta,
        ), $attributes['data']);

        return new self(
            $attributes['object'],
            $data,
            $attributes['first_id'],
            $attributes['last_id'],
            $attributes['has_more'],
            $meta,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'object' => $this->object,
            'data' => array_map(
                static fn (ThreadRunStepResponse $response): array => $response->toArray(),
                $this->data,
            ),
            'first_id' => $this->firstId,
            'last_id' => $this->lastId,
            'has_more' => $this->hasMore,
        ];
    }
}
