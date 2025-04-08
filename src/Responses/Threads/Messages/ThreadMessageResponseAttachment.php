<?php

declare(strict_types=1);

namespace OpenAI\Responses\Threads\Messages;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{file_id: string, tools: array<int, array{type: string}>}>
 */
final class ThreadMessageResponseAttachment implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{file_id: string, tools: array<int, array{type: string}>}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int,ThreadMessageResponseAttachmentFileSearchTool|ThreadMessageResponseAttachmentCodeInterpreterTool>  $tools
     */
    private function __construct(
        public string $fileId,
        public array $tools,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{file_id: string, tools: array<int, array{type: 'file_search'}|array{type: 'code_interpreter'}>}  $attributes
     */
    public static function from(array $attributes): self
    {
        $tools = array_map(fn (array $tool): ThreadMessageResponseAttachmentFileSearchTool|ThreadMessageResponseAttachmentCodeInterpreterTool => match ($tool['type']) {
            'file_search' => ThreadMessageResponseAttachmentFileSearchTool::from($tool),
            'code_interpreter' => ThreadMessageResponseAttachmentCodeInterpreterTool::from($tool),
        }, $attributes['tools']);

        return new self(
            $attributes['file_id'],
            $tools,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'file_id' => $this->fileId,
            'tools' => array_map(
                fn (ThreadMessageResponseAttachmentCodeInterpreterTool|ThreadMessageResponseAttachmentFileSearchTool $tool): array => $tool->toArray(),
                $this->tools,
            ),
        ];
    }
}
