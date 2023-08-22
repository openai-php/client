<?php

declare(strict_types=1);

namespace OpenAI\Responses\Concerns;

use OpenAI\Responses\Meta\MetaInformation;

trait HasMetaInformation
{
    public function meta(): MetaInformation
    {
        return $this->meta;
    }
}
