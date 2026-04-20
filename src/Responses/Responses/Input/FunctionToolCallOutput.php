<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Input;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type FunctionToolCallOutputTextType from FunctionToolCallOutputText
 * @phpstan-import-type FunctionToolCallOutputImageType from FunctionToolCallOutputImage
 * @phpstan-import-type FunctionToolCallOutputFileType from FunctionToolCallOutputFile
 *
 * @phpstan-type FunctionToolCallOutputType array{call_id: string, id: string, output: string|array<int, FunctionToolCallOutputTextType|FunctionToolCallOutputImageType|FunctionToolCallOutputFileType>, type: 'function_call_output', status: 'in_progress'|'completed'|'incompleted'}
 *
 * @implements ResponseContract<FunctionToolCallOutputType>
 */
final class FunctionToolCallOutput implements ResponseContract
{
    /**
     * @use ArrayAccessible<FunctionToolCallOutputType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'function_call_output'  $type
     * @param  'in_progress'|'completed'|'incompleted'  $status
     * @param  string|array<int, FunctionToolCallOutputText|FunctionToolCallOutputImage|FunctionToolCallOutputFile>  $output  Output can be a string (for text/JSON) or array (for structured content like files/images)
     */
    private function __construct(
        public readonly string $callId,
        public readonly string $id,
        public readonly string|array $output,
        public readonly string $type,
        public readonly string $status,
    ) {}

    /**
     * @param  FunctionToolCallOutputType  $attributes
     */
    public static function from(array $attributes): self
    {
        $output = $attributes['output'];

        if (is_array($output)) {
            $output = array_map(
                fn (array $item): FunctionToolCallOutputText|FunctionToolCallOutputImage|FunctionToolCallOutputFile => match ($item['type']) {
                    'input_text' => FunctionToolCallOutputText::from($item),
                    'input_image' => FunctionToolCallOutputImage::from($item),
                    'input_file' => FunctionToolCallOutputFile::from($item),
                },
                $output,
            );
        }

        return new self(
            callId: $attributes['call_id'],
            id: $attributes['id'],
            output: $output,
            type: $attributes['type'],
            status: $attributes['status'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'call_id' => $this->callId,
            'id' => $this->id,
            'output' => is_array($this->output)
                ? array_map(
                    fn (FunctionToolCallOutputText|FunctionToolCallOutputImage|FunctionToolCallOutputFile $item): array => $item->toArray(),
                    $this->output,
                )
                : $this->output,
            'type' => $this->type,
            'status' => $this->status,
        ];
    }
}
