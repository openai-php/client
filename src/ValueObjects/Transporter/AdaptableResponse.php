<?php

declare(strict_types=1);

namespace OpenAI\ValueObjects\Transporter;

use OpenAI\Responses\Meta\MetaInformation;

/**
 * @template-covariant TData of array|string
 *
 * @internal
 */
final readonly class AdaptableResponse
{
    /**
     * Creates a new AdaptableResponse value object.
     *
     * @param  TData  $data
     */
    private function __construct(
        private array|string $data,
        private MetaInformation $meta
    ) {
        // ..
    }

    /**
     * Creates a new AdaptableResponse value object from the given data and meta information.
     *
     * @param  TData  $data
     * @param  array<string, array<int, string>>  $headers
     * @return AdaptableResponse<TData>
     */
    public static function from(array|string $data, array $headers): self
    {
        $meta = MetaInformation::from($headers);

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
    public function meta(): MetaInformation
    {
        return $this->meta;
    }
}
