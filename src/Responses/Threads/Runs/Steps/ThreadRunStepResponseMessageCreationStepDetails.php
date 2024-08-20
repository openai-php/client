<?php

declare(strict_types=1);

namespace OpenAI\Responses\Threads\Runs\Steps;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{type: 'message_creation', message_creation: array{message_id: string}}>
 */
final class ThreadRunStepResponseMessageCreationStepDetails implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{type: 'message_creation', message_creation: array{message_id: string}}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'message_creation'  $type
     */
    private function __construct(
        public string $type,
        public ThreadRunStepResponseMessageCreation $messageCreation,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{type: 'message_creation', message_creation: array{message_id: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
            ThreadRunStepResponseMessageCreation::from($attributes['message_creation']),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'message_creation' => $this->messageCreation->toArray(),
        ];
    }
}
