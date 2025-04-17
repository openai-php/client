<?php

declare(strict_types=1);

namespace OpenAI\Exceptions;

use Exception;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class UnexpectedStatusCodeException extends Exception
{
    private RequestInterface $request;

    private ResponseInterface $response;

    /**
     * @var array{message: string|null, type: string|null, code: int|string|null}
     */
    private array $contents;

    /**
     * Creates a new UnexpectedStatusCodeException instance.
     *
     * @param  int  $statusCode  The unexpected HTTP status code.
     * @param  RequestInterface  $request  The request that was sent.
     * @param  ResponseInterface  $response  The response that was received.
     */
    public function __construct(int $statusCode, RequestInterface $request, ResponseInterface $response)
    {
        $this->request = $request;
        $this->response = $response;

        $body = (string) $response->getBody();
        $decoded = json_decode($body, true);

        $error = [];
        if (is_array($decoded) && isset($decoded['error']) && is_array($decoded['error'])) {
            $error = $decoded['error'];
        }

        $this->contents = [
            'message' => ($error['message'] ?? null) ?: "Unexpected status code: {$statusCode}",
            'type' => $error['type'] ?? null,
            'code' => $error['code'] ?? null,
        ];

        $message = $this->contents['message'];
        if (is_array($message)) {
            $message = implode(PHP_EOL, $message);
        }

        parent::__construct($message, $statusCode);
    }

    /**
     * Returns the HTTP status code of the response.
     */
    public function getStatusCode(): int
    {
        return $this->response->getStatusCode();
    }

    /**
     * Returns the error message.
     */
    public function getErrorMessage(): string
    {
        return $this->getMessage();
    }

    /**
     * Returns the error code if available.
     */
    public function getErrorCode(): string|int|null
    {
        return $this->contents['code'] ?? null;
    }

    /**
     * Returns the error type if available.
     */
    public function getErrorType(): ?string
    {
        return $this->contents['type'] ?? null;
    }

    /**
     * Returns the request that was made.
     */
    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    /**
     * Returns the response that was received.
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    /**
     * Returns a string representation of the request.
     */
    public function getRequestDetails(): string
    {
        return sprintf(
            'Request: %s %s',
            $this->request->getMethod(),
            $this->request->getUri()
        );
    }

    /**
     * Returns a string representation of the response.
     */
    public function getResponseDetails(): string
    {
        return sprintf(
            'Response: %d %s',
            $this->response->getStatusCode(),
            $this->response->getReasonPhrase()
        );
    }
}
