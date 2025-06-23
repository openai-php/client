<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Streaming;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Responses\Output\OutputMessageContentOutputTextAnnotationsContainerFile;
use OpenAI\Responses\Responses\Output\OutputMessageContentOutputTextAnnotationsFileCitation;
use OpenAI\Responses\Responses\Output\OutputMessageContentOutputTextAnnotationsFilePath;
use OpenAI\Responses\Responses\Output\OutputMessageContentOutputTextAnnotationsUrlCitation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type ContainerFileType from OutputMessageContentOutputTextAnnotationsContainerFile
 * @phpstan-import-type FileCitationType from OutputMessageContentOutputTextAnnotationsFileCitation
 * @phpstan-import-type FilePathType from OutputMessageContentOutputTextAnnotationsFilePath
 * @phpstan-import-type UrlCitationType from OutputMessageContentOutputTextAnnotationsUrlCitation
 *
 * @phpstan-type OutputTextAnnotationAddedType array{annotation: ContainerFileType|FileCitationType|FilePathType|UrlCitationType, annotation_index: int, content_index: int, item_id: string, output_index: int}
 *
 * @implements ResponseContract<OutputTextAnnotationAddedType>
 */
final class OutputTextAnnotationAdded implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<OutputTextAnnotationAddedType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    private function __construct(
        public readonly OutputMessageContentOutputTextAnnotationsContainerFile|OutputMessageContentOutputTextAnnotationsFileCitation|OutputMessageContentOutputTextAnnotationsFilePath|OutputMessageContentOutputTextAnnotationsUrlCitation $annotation,
        public readonly int $annotationIndex,
        public readonly int $contentIndex,
        public readonly string $itemId,
        public readonly int $outputIndex,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  OutputTextAnnotationAddedType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        $annotation = match ($attributes['annotation']['type']) {
            'file_citation' => OutputMessageContentOutputTextAnnotationsFileCitation::from($attributes['annotation']),
            'file_path' => OutputMessageContentOutputTextAnnotationsFilePath::from($attributes['annotation']),
            'url_citation' => OutputMessageContentOutputTextAnnotationsUrlCitation::from($attributes['annotation']),
            'container_file_citation' => OutputMessageContentOutputTextAnnotationsContainerFile::from($attributes['annotation']),
        };

        return new self(
            annotation: $annotation,
            annotationIndex: $attributes['annotation_index'],
            contentIndex: $attributes['content_index'],
            itemId: $attributes['item_id'],
            outputIndex: $attributes['output_index'],
            meta: $meta,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'annotation' => $this->annotation->toArray(),
            'annotation_index' => $this->annotationIndex,
            'content_index' => $this->contentIndex,
            'item_id' => $this->itemId,
            'output_index' => $this->outputIndex,
        ];
    }
}
