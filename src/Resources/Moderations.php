<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Responses\Moderations\CreateResponse;
use OpenAI\ValueObjects\Transporter\Payload;

final class Moderations
{
    use Concerns\Transportable;

    /**
     * Classifies if text violates OpenAI's Content Policy.
     *
     * @see https://beta.openai.com/docs/api-reference/moderations/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): CreateResponse
    {
        $payload = Payload::create('moderations', $parameters);

        /** @var array{id: string, model: string, results: array<int, array{categories: array<string, bool>, category_scores: array<string, float>, flagged: bool}>} $result */
        $result = $this->transporter->requestObject($payload);

        return CreateResponse::from($result);
    }
}
