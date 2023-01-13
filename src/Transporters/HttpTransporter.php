<?php

declare(strict_types=1);

namespace OpenAI\Transporters;

use GuzzleHttp\ClientInterface;
use JsonException;
use OpenAI\Contracts\Transporter;
use OpenAI\Exceptions\ErrorException;
use OpenAI\Exceptions\TransporterException;
use OpenAI\ValueObjects\Transporter\BaseUri;
use OpenAI\ValueObjects\Transporter\Headers;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;
use Psr\Http\Client\ClientExceptionInterface;

/**
 * @internal
 */
final class HttpTransporter implements Transporter
{
    /**
     * Creates a new Http Transporter instance.
     */
    public function __construct(
        private readonly ClientInterface $client,
        private readonly BaseUri $baseUri,
        private readonly Headers $headers,
    ) {
        // ..
    }

    /**
     * {@inheritDoc}
     */
    public function requestObject(Payload $payload): Response
    {
        try {
            return new Response(
                $this->client->send(
                    $payload->toRequest($this->baseUri, $this->headers),
                    ['stream' => $payload->isStream()]
                )
            );
        } catch (ClientExceptionInterface $clientException) {
            throw new TransporterException($clientException);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function requestContent(Payload $payload): string
    {
        $request = $payload->toRequest($this->baseUri, $this->headers);

        try {
            $response = $this->client->send($request);
        } catch (ClientExceptionInterface $clientException) {
            throw new TransporterException($clientException);
        }

        $contents = $response->getBody()->getContents();

        try {
            /** @var array{error?: array{message: string, type: string, code: string}} $response */
            $response = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);

            if (isset($response['error'])) {
                throw new ErrorException($response['error']);
            }
        } catch (JsonException) {
            // ..
        }

        return $contents;
    }
}
