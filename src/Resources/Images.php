<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\ImagesContract;
use OpenAI\Events\RequestHandled;
use OpenAI\Responses\Images\CreateResponse;
use OpenAI\Responses\Images\EditResponse;
use OpenAI\Responses\Images\VariationResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

final class Images extends Resource implements ImagesContract
{
    /**
     * Creates an image given a prompt.
     *
     * @see https://platform.openai.com/docs/api-reference/images/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): CreateResponse
    {
        $payload = Payload::create('images/generations', $parameters);

        /** @var Response<array{created: int, data: array<int, array{url?: string, b64_json?: string, revised_prompt?: string}>}> $responseRaw */
        $responseRaw = $this->transporter->requestObject($payload);

        $response = CreateResponse::from($responseRaw->data(), $responseRaw->meta());

        $this->event(new RequestHandled($payload, $response));

        return $response;
    }

    /**
     * Creates an edited or extended image given an original image and a prompt.
     *
     * @see https://platform.openai.com/docs/api-reference/images/create-edit
     *
     * @param  array<string, mixed>  $parameters
     */
    public function edit(array $parameters): EditResponse
    {
        $payload = Payload::upload('images/edits', $parameters);

        /** @var Response<array{created: int, data: array<int, array{url?: string, b64_json?: string}>}> $responseRaw */
        $responseRaw = $this->transporter->requestObject($payload);

        $response = EditResponse::from($responseRaw->data(), $responseRaw->meta());

        $this->event(new RequestHandled($payload, $response));

        return $response;
    }

    /**
     * Creates a variation of a given image.
     *
     * @see https://platform.openai.com/docs/api-reference/images/create-variation
     *
     * @param  array<string, mixed>  $parameters
     */
    public function variation(array $parameters): VariationResponse
    {
        $payload = Payload::upload('images/variations', $parameters);

        /** @var Response<array{created: int, data: array<int, array{url?: string, b64_json?: string}>}> $responseRaw */
        $responseRaw = $this->transporter->requestObject($payload);

        $response = VariationResponse::from($responseRaw->data(), $responseRaw->meta());

        $this->event(new RequestHandled($payload, $response));

        return $response;
    }
}
