<?php

declare(strict_types=1);

namespace OpenAI\Responses\Threads\Runs\Steps;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{input: string, outputs: array<int, array{type: string, image: array{file_id: string}}|array{type: string, logs: string}>}>
 */
final class ThreadRunStepResponseCodeInterpreter implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{input: string, outputs: array<int, array{type: string, image: array{file_id: string}}|array{type: string, logs: string}>}>
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
     * @param  array{input: string, outputs: array<int, array{type: 'image', image: array{file_id: string}}|array{type: 'logs', logs: string}>}  $attributes
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
