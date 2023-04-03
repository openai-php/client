<?php

namespace OpenAI\Testing\Resources;

use OpenAI\Contracts\Resources\ImagesContract;
use OpenAI\Resources\Images;
use OpenAI\Responses\Images\CreateResponse;
use OpenAI\Responses\Images\EditResponse;
use OpenAI\Responses\Images\VariationResponse;
use OpenAI\Testing\Resources\Concerns\Testable;

final class ImagesTestResource implements ImagesContract
{
    use Testable;

    protected function resource(): string
    {
        return Images::class;
    }

    public function create(array $parameters): CreateResponse
    {
        return $this->record(__FUNCTION__, $parameters);
    }

    public function edit(array $parameters): EditResponse
    {
        return $this->record(__FUNCTION__, $parameters);
    }

    public function variation(array $parameters): VariationResponse
    {
        return $this->record(__FUNCTION__, $parameters);
    }
}
