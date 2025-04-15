<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Responses\Responses\Output\OutputMessageContentOutputTextAnnotationsFileCitation as FileCitation;
use OpenAI\Responses\Responses\Output\OutputMessageContentOutputTextAnnotationsFilePath as FilePath;
use OpenAI\Responses\Responses\Output\OutputMessageContentOutputTextAnnotationsUrlCitation as UrlCitation;

final class OutputMessageContentOutputTextAnnotations
{
    /**
     * @param  array<FileCitation|FilePath|UrlCitation>  $annotations
     */
    private function __construct(
        public readonly array $annotations,
    ) {}

    /**
     * @param  array{annotations: array<int, array{file_id: string, index: int, type: 'file_citation'}|array{file_id: string, index: int, type: 'file_path'}|array{end_index: int, start_index: int, title: string, type: 'url_citation', url: string}>}  $attributes
     */
    public static function from(array $attributes): self
    {
        $annotations = array_map(
            fn (array $annotation): FileCitation|FilePath|UrlCitation => match ($annotation['type']) {
                'file_citation' => FileCitation::from($annotation),
                'file_path' => FilePath::from($annotation),
                'url_citation' => UrlCitation::from($annotation),
            },
            $attributes['annotations'],
        );

        return new self(
            $annotations,
        );
    }

    /**
     * @return array{annotations: array<int, array{file_id: string, index: int, type: 'file_citation'}|array{file_id: string, index: int, type: 'file_path'}|array{end_index: int, start_index: int, title: string, type: 'url_citation', url: string}>}
     */
    public function toArray(): array
    {
        return [
            'annotations' => array_map(
                fn (FileCitation|FilePath|UrlCitation $annotation): array => $annotation->toArray(),
                $this->annotations,
            ),
        ];
    }
}
