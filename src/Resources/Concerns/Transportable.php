<?php

declare(strict_types=1);

namespace OpenAI\Resources\Concerns;

use OpenAI\Contracts\TransporterContract;

trait Transportable
{
    /**
     * Creates a Client instance with the given API token.
     */
    public function __construct(private readonly TransporterContract $transporter)
    {
        // ..
    }
}
