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
 * @phpstan-import-type FileCitationType from OutputMessageContentOutputTextAnnotationsFileCitation
 * @phpstan-import-type FilePathType from OutputMessageContentOutputTextAnnotationsFilePath
 * @phpstan-import-type UrlCitationType from OutputMessageContentOutputTextAnnotationsUrlCitation
 *
 * @phpstan-type OutputTextType array{annotations: array<int, FileCitationType|FilePathType|UrlCitationType>, text: string, type: 'output_text'}
 *
 * @implements ResponseContract<OutputTextType>
 */
final class OutputMessageContentOutputText implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputTextType>
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
     * @param  OutputTextType  $attributes
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
