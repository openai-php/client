<?php

declare(strict_types=1);

namespace OpenAI\Responses\Images;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{created: int, data: array<int, array{url?: string, b64_json?: string}>, usage?: array{total_tokens: int, input_tokens: int, output_tokens: int, input_tokens_details: array{text_tokens: int, image_tokens: int}}}>
 */
final class EditResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<array{created: int, data: array<int, array{url?: string, b64_json?: string}>, usage?: array{total_tokens: int, input_tokens: int, output_tokens: int, input_tokens_details: array{text_tokens: int, image_tokens: int}}}>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  array<int, EditResponseData>  $data
     */
    private function __construct(
        public readonly int $created,
        public readonly array $data,
        private readonly MetaInformation $meta,
        public readonly ?ImageResponseUsage $usage = null,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{created: int, data: array<int, array{url?: string, b64_json?: string}>, usage?: array{total_tokens: int, input_tokens: int, output_tokens: int, input_tokens_details: array{text_tokens: int, image_tokens: int}}}  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        $results = array_map(fn (array $result): EditResponseData => EditResponseData::from(
            $result
        ), $attributes['data']);

        return new self(
            $attributes['created'],
            $results,
            $meta,
            isset($attributes['usage']) ? ImageResponseUsage::from($attributes['usage']) : null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        $result = [
            'created' => $this->created,
            'data' => array_map(
                static fn (EditResponseData $result): array => $result->toArray(),
                $this->data,
            ),
        ];

        if ($this->usage !== null) {
            $result['usage'] = $this->usage->toArray();
        }

        return $result;
    }
}
