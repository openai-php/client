<?php

namespace OpenAI\Exceptions;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class APIStatusError extends APIError
{
    protected int $statusCode;
    protected ?string $requestId;

    public function __construct(RequestInterface $request, protected readonly ResponseInterface $response, array $contents)
    {
        parent::__construct($request, $contents);

        $this->statusCode = $response->getStatusCode();
        $this->requestId = $response->getHeader('x-request-id')[0] ?? null;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getRequestId(): ?string
    {
        return $this->requestId;
    }
}
