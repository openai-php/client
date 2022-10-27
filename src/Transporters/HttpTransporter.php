<?php

declare(strict_types=1);

namespace OpenAI\Transporters;

use JsonException;
use OpenAI\Contracts\Transporter;
use OpenAI\Exceptions\ErrorException;
use OpenAI\Exceptions\InvalidApiKeyException;
use OpenAI\Exceptions\InvalidRequestException;
use OpenAI\Exceptions\TransporterException;
use OpenAI\Exceptions\UnserializableResponse;
use OpenAI\ValueObjects\Transporter\BaseUri;
use OpenAI\ValueObjects\Transporter\Headers;
use OpenAI\ValueObjects\Transporter\Payload;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;

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
    public function requestObject(Payload $payload): array
    {
        $request = $payload->toRequest($this->baseUri, $this->headers);

        try {
            $response = $this->client->sendRequest($request);
        } catch (ClientExceptionInterface $clientException) {
            throw new TransporterException($clientException);
        }

        $contents = $response->getBody()->getContents();

        try {
            /** @var array{error?: array{message: string, type: string, param: string, code: string}} $response */
            $response = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $jsonException) {
            throw new UnserializableResponse($jsonException);
        }

        if (isset($response['error'])) {
            $this->handleError($response['error']);
        }

        return $response;
    }

    /**
     * {@inheritDoc}
     */
    public function requestContent(Payload $payload): string
    {
        $request = $payload->toRequest($this->baseUri, $this->headers);

        try {
            $response = $this->client->sendRequest($request);
        } catch (ClientExceptionInterface $clientException) {
            throw new TransporterException($clientException);
        }

        $contents = $response->getBody()->getContents();

        try {
            /** @var array{error?: array{message: string, type: string, param: string, code: string}} $response */
            $response = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);

            if (isset($response['error'])) {
                $this->handleError($response['error']);
            }
        } catch (JsonException) {
            // ..
        }

        return $contents;
    }

    /**
     * @param  array{message: string, type: string, param: string, code: string}  $error
     *
     * @throws ErrorException
     */
    private function handleError(array $error): void
    {
        match ($error['code']) {
            'invalid_api_key' => throw new InvalidApiKeyException($error),
            default => null,
        };

        match ($error['type']) {
            'invalid_request_error' => throw new InvalidRequestException($error),
            default => throw new ErrorException($error),
        };
    }
}
