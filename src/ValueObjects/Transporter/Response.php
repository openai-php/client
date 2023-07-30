<?php

declare(strict_types=1);

namespace OpenAI\ValueObjects\Transporter;

use OpenAI\Responses\ResponseMetaInformation;

/**
 * @template-covariant TData of array|string
 *
 * @internal
 */
final class Response
{
    /**
     * Creates a new Response value object.
     *
     * @param  TData  $data
     */
    private function __construct(
        private readonly array|string $data,
        private readonly ResponseMetaInformation $meta
    ) {
        // ..
    }

    /**
     * Creates a new Response value object from the given data and meta information.
     *
     * @param  TData  $data
     * @param  array<string, array<int, string>>  $headers
     * @return Response<TData>
     */
    public static function from(array|string $data, array $headers): self
    {
        // @phpstan-ignore-next-line
        $meta = ResponseMetaInformation::from($headers);

        return new self($data, $meta);
    }

    /**
     * Returns the response data.
     *
     * @return TData
     */
    public function data(): array|string
    {
        return $this->data;
    }

    /**
     * Returns the meta information.
     */
    public function meta(): ResponseMetaInformation
    {
        return $this->meta;
    }
}
