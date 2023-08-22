<?php

declare(strict_types=1);

namespace OpenAI\Contracts;

use OpenAI\Responses\ResponseMetaInformation;

interface ResponseHasMetaInformationContract
{
    public function meta(): ResponseMetaInformation;
}
