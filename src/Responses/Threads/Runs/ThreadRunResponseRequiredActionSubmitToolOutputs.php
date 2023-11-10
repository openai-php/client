<?php

declare(strict_types=1);

namespace OpenAI\Responses\Threads\Runs;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{}>
 */
final class ThreadRunResponseRequiredActionSubmitToolOutputs implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, RequiredActionFunctionToolCall>  $toolCalls
     */
    private function __construct(
        public array $toolCalls,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{}  $attributes
     */
    public static function from(array $attributes): self
    {
        $toolCalls = array_map(fn (array $toolCall): \OpenAI\Responses\Threads\Runs\ThreadRunResponseRequiredActionFunctionToolCall => ThreadRunResponseRequiredActionFunctionToolCall::from($toolCall), $attributes['tool_calls']);

        return new self(
            $toolCalls,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'tool_calls' => array_map(fn (ThreadRunResponseRequiredActionFunctionToolCall $toolCall): array => $toolCall->toArray(), $this->toolCalls),
        ];
    }
}
