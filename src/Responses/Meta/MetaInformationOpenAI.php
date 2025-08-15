<?php

namespace OpenAI\Responses\Meta;

final class MetaInformationOpenAI
{
    private function __construct(
        public readonly ?string $model,
        public readonly ?string $organization,
        public readonly ?string $project,
        public readonly ?string $version,
        public readonly ?int $processingMs,
    ) {}

    /**
     * @param  array{model: ?string, organization: ?string, project: ?string, version: ?string, processingMs: ?int}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['model'],
            $attributes['organization'],
            $attributes['project'],
            $attributes['version'],
            $attributes['processingMs'],
        );
    }
}
