<?php

declare(strict_types=1);

namespace OpenAI\Responses\Concerns;

use OpenAI\Responses\ResponseMetaInformation;

trait HasMetaInformation
{
    public function meta(): ResponseMetaInformation
    {
        return $this->meta;
    }
}
