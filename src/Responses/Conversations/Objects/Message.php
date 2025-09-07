<?php

declare(strict_types=1);

namespace OpenAI\Responses\Conversations\Objects;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Conversations\Objects\MessageTypes\ComputerScreenshotContent as ComputerScreenshot;
use OpenAI\Responses\Conversations\Objects\MessageTypes\SummaryText;
use OpenAI\Responses\Conversations\Objects\MessageTypes\TextContent as Text;
use OpenAI\Responses\Responses\Input\InputMessageContentInputFile as InputFile;
use OpenAI\Responses\Responses\Input\InputMessageContentInputImage as InputImage;
use OpenAI\Responses\Responses\Input\InputMessageContentInputText as InputText;
use OpenAI\Responses\Responses\Output\OutputMessageContentOutputText as OutputText;
use OpenAI\Responses\Responses\Output\OutputMessageContentRefusal as Refusal;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type ContentInputTextType from InputText as InputTextType
 * @phpstan-import-type ContentInputImageType from InputImage as InputImageType
 * @phpstan-import-type ContentInputFileType from InputFile as InputFileType
 * @phpstan-import-type OutputTextType from OutputText
 * @phpstan-import-type ContentRefusalType from Refusal as RefusalType
 * @phpstan-import-type ComputerScreenshotContentType from ComputerScreenshot as ComputerScreenshotType
 * @phpstan-import-type SummaryTextType from SummaryText
 * @phpstan-import-type TextContentType from Text
 *
 * @phpstan-type MessageType array{content: array<int, InputTextType|InputImageType|InputFileType|OutputTextType|RefusalType|TextContentType|SummaryTextType|ComputerScreenshotType>, id: string, role: 'unknown'|'user'|'assistant'|'system'|'critic'|'discriminator'|'developer'|'tool', status: 'in_progress'|'completed'|'incomplete', type: 'message'}
 *
 * @implements ResponseContract<MessageType>
 */
final class Message implements ResponseContract
{
    /**
     * @use ArrayAccessible<MessageType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, InputText|InputImage|InputFile|OutputText|Refusal|ComputerScreenshot|SummaryText|Text>  $content
     * @param  'unknown'|'user'|'assistant'|'system'|'critic'|'discriminator'|'developer'|'tool'  $role
     * @param  'in_progress'|'completed'|'incomplete'  $status
     * @param  'message'  $type
     */
    private function __construct(
        public readonly array $content,
        public readonly string $id,
        public readonly string $role,
        public readonly string $status,
        public readonly string $type,
    ) {}

    /**
     * @param  MessageType  $attributes
     */
    public static function from(array $attributes): self
    {
        $content = array_map(
            fn (array $item): InputText|InputImage|InputFile|OutputText|Refusal|ComputerScreenshot|SummaryText|Text => match ($item['type']) {
                'computer_screenshot' => ComputerScreenshot::from($item),
                'input_file' => InputFile::from($item),
                'input_image' => InputImage::from($item),
                'input_text' => InputText::from($item),
                'output_text' => OutputText::from($item),
                'refusal' => Refusal::from($item),
                'summary_text' => SummaryText::from($item),
                'text' => Text::from($item),
            },
            $attributes['content'],
        );

        return new self(
            content: $content,
            id: $attributes['id'],
            role: $attributes['role'],
            status: $attributes['status'],
            type: $attributes['type'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'content' => array_map(
                fn (InputText|InputImage|InputFile|OutputText|Refusal|ComputerScreenshot|SummaryText|Text $item): array => $item->toArray(),
                $this->content,
            ),
            'id' => $this->id,
            'role' => $this->role,
            'status' => $this->status,
            'type' => $this->type,
        ];
    }
}
