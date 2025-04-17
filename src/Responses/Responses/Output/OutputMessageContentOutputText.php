<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Responses\Output\OutputMessageContentOutputTextAnnotationsFileCitation as AnnotationFileCitation;
use OpenAI\Responses\Responses\Output\OutputMessageContentOutputTextAnnotationsFilePath as AnnotationFilePath;
use OpenAI\Responses\Responses\Output\OutputMessageContentOutputTextAnnotationsUrlCitation as AnnotationUrlCitation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{annotations: array<int, array{file_id: string, index: int, type: 'file_citation'}|array{file_id: string, index: int, type: 'file_path'}|array{end_index: int, start_index: int, title: string, type: 'url_citation', url: string}>, text: string, type: 'output_text'}>
 */
final class OutputMessageContentOutputText implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{annotations: array<int, array{file_id: string, index: int, type: 'file_citation'}|array{file_id: string, index: int, type: 'file_path'}|array{end_index: int, start_index: int, title: string, type: 'url_citation', url: string}>, text: string, type: 'output_text'}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, AnnotationFileCitation|AnnotationFilePath|AnnotationUrlCitation>  $annotations
     * @param  'output_text'  $type
     */
    private function __construct(
        public readonly array $annotations,
        public readonly string $text,
        public readonly string $type
    ) {}

    /**
     * @param  array{annotations: array<int, array{file_id: string, index: int, type: 'file_citation'}|array{file_id: string, index: int, type: 'file_path'}|array{end_index: int, start_index: int, title: string, type: 'url_citation', url: string}>, text: string, type: 'output_text'}  $attributes
     */
    public static function from(array $attributes): self
    {
        $annotations = array_map(
            fn (array $annotation): AnnotationFileCitation|AnnotationFilePath|AnnotationUrlCitation => match ($annotation['type']) {
                'file_citation' => AnnotationFileCitation::from($annotation),
                'file_path' => AnnotationFilePath::from($annotation),
                'url_citation' => AnnotationUrlCitation::from($annotation),
            },
            $attributes['annotations'],
        );

        return new self(
            annotations: $annotations,
            text: $attributes['text'],
            type: $attributes['type'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'annotations' => array_map(
                fn (AnnotationFileCitation|AnnotationFilePath|AnnotationUrlCitation $annotation): array => $annotation->toArray(),
                $this->annotations,
            ),
            'text' => $this->text,
            'type' => $this->type,
        ];
    }
}
