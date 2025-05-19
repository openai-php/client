<?php

declare(strict_types=1);

namespace OpenAI\Responses\Images;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;
use OpenAI\Responses\Images\ImageResponseUsage;

/**
 * @implements ResponseContract<array{created: int, data: array<int, array{url?: string, b64_json?: string}>, usage?: array{total_tokens: int, input_tokens: int, output_tokens: int, input_tokens_details: array{text_tokens: int, image_tokens: int}}}>
 */
final class VariationResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<array{created: int, data: array<int, array{url?: string, b64_json?: string}>, usage?: array{total_tokens: int, input_tokens: int, output_tokens: int, input_tokens_details: array{text_tokens: int, image_tokens: int}}}>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  array<int, VariationResponseData>  $data
     */
    private function __construct(
        public readonly int $created,
        public readonly array $data,
        private readonly MetaInformation $meta,
        public readonly ?ImageResponseUsage $usage,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{created: int, data: array<int, array{url?: string, b64_json?: string}>, usage?: array{total_tokens: int, input_tokens: int, output_tokens: int, input_tokens_details: array{text_tokens: int, image_tokens: int}}}  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        $results = array_map(fn (array $result): VariationResponseData => VariationResponseData::from(
            $result
        ), $attributes['data']);

        $usage = isset($attributes['usage']) ? ImageResponseUsage::from($attributes['usage']) : null;

        return new self(
            $attributes['created'],
            $results,
            $meta,
            $usage,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        $data = array_map(
            static fn (VariationResponseData $result): array => $result->toArray(),
            $this->data,
        );

        $result = [
            'created' => $this->created,
            'data' => $data,
        ];

        if ($this->usage !== null) {
            $result['usage'] = $this->usage->toArray();
        }

        return $result;
    }
}
