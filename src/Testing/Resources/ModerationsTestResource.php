<?php

namespace OpenAI\Testing\Resources;

use OpenAI\Contracts\Resources\ModerationsContract;
use OpenAI\Resources\Moderations;
use OpenAI\Responses\Moderations\CreateResponse;
use OpenAI\Testing\Resources\Concerns\Testable;

final class ModerationsTestResource implements ModerationsContract
{
    use Testable;

    protected function resource(): string
    {
        return Moderations::class;
    }

    public function create(array $parameters): CreateResponse
    {
        return $this->record(__FUNCTION__, $parameters);
    }
}
