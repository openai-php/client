<?php

declare(strict_types=1);

namespace OpenAI\Responses\Threads\Runs\Steps;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{}>
 */
final class ThreadRunStepResponseCodeInterpreter implements ResponseContract
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
        public string $input,
        public array $outputs,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{}  $attributes
     */
    public static function from(array $attributes): self
    {
        $outputs = array_map(
            fn (array $output): \OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepResponseCodeInterpreterOutputImage|\OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepResponseCodeInterpreterOutputLogs => match ($output['type']) {
                'image' => ThreadRunStepResponseCodeInterpreterOutputImage::from($output),
                'logs' => ThreadRunStepResponseCodeInterpreterOutputLogs::from($output),
            },
            $attributes['outputs'],
        );

        return new self(
            $attributes['input'],
            $outputs,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'input' => $this->input,
            'outputs' => array_map(
                fn (ThreadRunStepResponseCodeInterpreterOutputImage|ThreadRunStepResponseCodeInterpreterOutputLogs $output): array => $output->toArray(),
                $this->outputs,
            ),
        ];
    }
}
