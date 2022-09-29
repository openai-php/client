<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\DataObjectFactories\Moderation\ModerationResponseFactory;
use OpenAI\DataObjects\Moderation\ModerationResponse;
use OpenAI\Requests\Moderation\ModerationCreateRequest;
use OpenAI\ValueObjects\Transporter\Payload;

final class Moderations
{
    use Concerns\Transportable;

    /**
     * Classifies if text violates OpenAI's Content Policy.
     *
     * @see https://beta.openai.com/docs/api-reference/moderations/create
     */
    public function create(ModerationCreateRequest $request): ModerationResponse
    {
        $payload = Payload::createFromRequest('moderations', $request);

        /** @var array<string, mixed> $result */
        $result = $this->transporter->requestObject($payload);

        return ModerationResponseFactory::new($result);
    }
}
