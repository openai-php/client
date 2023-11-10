<?php

declare(strict_types=1);

namespace OpenAI\Responses\Threads\Runs\Steps;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{}>
 */
final class ThreadRunStepResponseCodeInterpreterOutputImage implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, ThreadRunStepResponseCodeInterpreterOutputLogs|ThreadRunStepResponseCodeInterpreterOutputImage>  $outputs
     */
    private function __construct(
        public string $type,
        public ThreadRunStepResponseCodeInterpreterOutputImageImage $image,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
            ThreadRunStepResponseCodeInterpreterOutputImageImage::from($attributes['image']),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'image' => $this->image->toArray(),
        ];
    }
}
