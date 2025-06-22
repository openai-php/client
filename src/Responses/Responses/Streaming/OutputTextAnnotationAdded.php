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
        $annotationType = $attributes['annotation']['type'];

        // Handle container_file types with any suffix
        if (str_starts_with($annotationType, 'container_file')) {
            /** @var ContainerFileType $containerFileAttributes */
            $containerFileAttributes = $attributes['annotation'];
            $annotation = OutputMessageContentOutputTextAnnotationsContainerFile::from($containerFileAttributes);
        } else {
            $annotation = match ($annotationType) {
                'file_citation' => (static function (array $ann) {
                    /** @var FileCitationType $ann */
                    return OutputMessageContentOutputTextAnnotationsFileCitation::from($ann);
                })($attributes['annotation']),
                'file_path' => (static function (array $ann) {
                    /** @var FilePathType $ann */
                    return OutputMessageContentOutputTextAnnotationsFilePath::from($ann);
                })($attributes['annotation']),
                'url_citation' => (static function (array $ann) {
                    /** @var UrlCitationType $ann */
                    return OutputMessageContentOutputTextAnnotationsUrlCitation::from($ann);
                })($attributes['annotation']),
                default => throw new \UnhandledMatchError("Unhandled annotation type: {$annotationType}")
            };
        }

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
