<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Streaming;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Responses\CreateResponse;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type CreateResponseType from CreateResponse
 *
 * @phpstan-type ResponseType array{type: string, response: CreateResponseType, sequence_number: int}
 *
 * @implements ResponseContract<ResponseType>
 */
final class Response implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<ResponseType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    private function __construct(
        public readonly string $type,
        public readonly CreateResponse $response,
        public readonly int $sequenceNumber,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  ResponseType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            type: $attributes['type'],
            response: CreateResponse::from($attributes['response'], $meta),
            sequenceNumber: $attributes['sequence_number'],
            meta: $meta,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'response' => $this->response->toArray(),
            'sequence_number' => $this->sequenceNumber,
        ];
    }
}
