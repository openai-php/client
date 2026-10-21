<?php

declare(strict_types=1);

namespace OpenAI\Responses\Agents\Environments\Objects;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type PackagesType array{npm: array<int, string>, python: array<int, string>, system: array<int, string>}
 *
 * @implements ResponseContract<PackagesType>
 */
final class Packages implements ResponseContract
{
    /**
     * @use ArrayAccessible<PackagesType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, string>  $npm
     * @param  array<int, string>  $python
     * @param  array<int, string>  $system
     */
    private function __construct(
        public readonly array $npm,
        public readonly array $python,
        public readonly array $system,
    ) {}

    /**
     * @param  PackagesType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            npm: $attributes['npm'],
            python: $attributes['python'],
            system: $attributes['system'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'npm' => $this->npm,
            'python' => $this->python,
            'system' => $this->system,
        ];
    }
}
