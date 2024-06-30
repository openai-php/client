<?php

declare(strict_types=1);

namespace OpenAI\Transporters;

use Closure;
use GuzzleHttp\Exception\ClientException;
use JsonException;
use OpenAI\Contracts\TransporterContract;
use OpenAI\Enums\Transporter\ContentType;
use OpenAI\Exceptions\AuthenticationError;
use OpenAI\Exceptions\BadRequestError;
use OpenAI\Exceptions\ConflictError;
use OpenAI\Exceptions\ErrorException;
use OpenAI\Exceptions\NotFoundError;
use OpenAI\Exceptions\PermissionDeniedError;
use OpenAI\Exceptions\RateLimitError;
use OpenAI\Exceptions\TransporterException;
use OpenAI\Exceptions\UnprocessableEntityError;
use OpenAI\Exceptions\UnserializableResponse;
use OpenAI\ValueObjects\Transporter\BaseUri;
use OpenAI\ValueObjects\Transporter\Headers;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\QueryParams;
use OpenAI\ValueObjects\Transporter\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 */
final class HttpTransporter implements TransporterContract
{
    /**
     * Creates a new Http Transporter instance.
     */
    public function __construct(
        private readonly ClientInterface $client,
        private readonly BaseUri $baseUri,
        private readonly Headers $headers,
        private readonly QueryParams $queryParams,
        private readonly Closure $streamHandler,
    ) {
        // ..
    }

    /**
     * {@inheritDoc}
     */
    public function requestObject(Payload $payload): Response
    {
        $request = $payload->toRequest($this->baseUri, $this->headers, $this->queryParams);

        $response = $this->sendRequest(
            fn (): \Psr\Http\Message\ResponseInterface => $this->client->sendRequest($request),
            $request
        );

        $contents = $response->getBody()->getContents();

        if (str_contains($response->getHeaderLine('Content-Type'), ContentType::TEXT_PLAIN->value)) {
            return Response::from($contents, $response->getHeaders());
        }

        $this->throwIfJsonError($request, $response, $contents);

        try {
            /** @var array{error?: array{message: string, type: string, code: string}} $data */
            $data = json_decode($contents, true, flags: JSON_THROW_ON_ERROR);
        } catch (JsonException $jsonException) {
            throw new UnserializableResponse($jsonException);
        }

        return Response::from($data, $response->getHeaders());
    }

    /**
     * {@inheritDoc}
     */
    public function requestContent(Payload $payload): string
    {
        $request = $payload->toRequest($this->baseUri, $this->headers, $this->queryParams);

        $response = $this->sendRequest(
            fn (): \Psr\Http\Message\ResponseInterface => $this->client->sendRequest($request),
            $request
        );

        $contents = $response->getBody()->getContents();

        $this->throwIfJsonError($request, $response, $contents);

        return $contents;
    }

    /**
     * {@inheritDoc}
     */
    public function requestStream(Payload $payload): ResponseInterface
    {
        $request = $payload->toRequest($this->baseUri, $this->headers, $this->queryParams);

        $response = $this->sendRequest(fn () => ($this->streamHandler)($request), $request);

        $this->throwIfJsonError($request, $response, $response);

        return $response;
    }

    private function sendRequest(Closure $callable, RequestInterface $request): ResponseInterface
    {
        try {
            return $callable();
        } catch (ClientExceptionInterface $clientException) {
            if ($clientException instanceof ClientException) {
                $this->throwIfJsonError($request, $clientException->getResponse(), $clientException->getResponse()->getBody()->getContents());
            }

            throw new TransporterException($clientException);
        }
    }

    /**
     * @throws NotFoundError
     * @throws RateLimitError
     * @throws AuthenticationError
     * @throws UnserializableResponse
     * @throws ErrorException
     * @throws BadRequestError
     * @throws UnprocessableEntityError
     * @throws ConflictError
     * @throws PermissionDeniedError
     */
    private function throwIfJsonError(RequestInterface $request, ResponseInterface $response, string|ResponseInterface $contents): void
    {
        if ($response->getStatusCode() < 400) {
            return;
        }

        if (! str_contains($response->getHeaderLine('Content-Type'), ContentType::JSON->value)) {
            return;
        }

        if ($contents instanceof ResponseInterface) {
            $contents = $contents->getBody()->getContents();
        }

        try {
            /** @var array{error: array{message: string|array<int, string>, type: string, code: string}} $contentDecoded */
            $contentDecoded = json_decode($contents, true, flags: JSON_THROW_ON_ERROR);

            $error = $contentDecoded['error'];

            throw match ($response->getStatusCode()) {
                400 => new BadRequestError($request, $response, $error),
                401 => new AuthenticationError($request, $response, $error),
                403 => new PermissionDeniedError($request, $response, $error),
                404 => new NotFoundError($request, $response, $error),
                409 => new ConflictError($request, $response, $error),
                422 => new UnprocessableEntityError($request, $response, $error),
                429 => new RateLimitError($request, $response, $error),
                default => new ErrorException($contentDecoded['error']),
            };
        } catch (JsonException $jsonException) {
            throw new UnserializableResponse($jsonException);
        }
    }
}
