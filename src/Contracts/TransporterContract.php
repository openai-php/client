<?php

declare(strict_types=1);

namespace OpenAI\Contracts;

use OpenAI\Exceptions\OpenAIThrowable;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;
use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 */
interface TransporterContract
{
    /**
     * Sends a request to a server.
     *
     * @return Response<array<array-key, mixed>|string>
     *
     * @throws OpenAIThrowable
     */
    public function requestObject(Payload $payload): Response;

    /**
     * Sends a content request to a server.
     *
     * @throws OpenAIThrowable
     */
    public function requestContent(Payload $payload): string;

    /**
     * Sends a stream request to a server.
     **
     * @throws OpenAIThrowable
     */
    public function requestStream(Payload $payload): ResponseInterface;
}
