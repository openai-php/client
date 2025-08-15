<?php

declare(strict_types=1);

namespace OpenAI\ValueObjects\Transporter;

use OpenAI\Responses\Meta\MetaInformation;

/**
 * @template-covariant TData of array
 *
 * @internal
 */
final readonly class Response
{
    /**
     * Creates a new Response value object.
     *
     * @param  TData  $data
     */
    private function __construct(
        private array $data,
        private MetaInformation $meta
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
    public static function from(array $data, array $headers): self
    {
        $meta = MetaInformation::from($headers);

        return new self($data, $meta);
    }

    /**
     * Returns the response data.
     *
     * @return TData
     */
    public function data(): array
    {
        return $this->data;
    }

    /**
     * Returns the meta information.
     */
    public function meta(): MetaInformation
    {
        return $this->meta;
    }
}
