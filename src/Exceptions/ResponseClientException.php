<?php

declare(strict_types=1);

namespace OpenAI\Exceptions;

use Exception;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestInterface;

class ResponseClientException extends \RuntimeException implements ClientExceptionInterface
{
    private RequestInterface $request;

    /**
     * @param string $message
     * @param RequestInterface $request
     * @param int $statusCode
     * @param Exception|null $previous
     */
    public function __construct(string $message, RequestInterface $request, int $statusCode = 0, Exception $previous = null)
    {
        parent::__construct($message, $statusCode, $previous);
        $this->request = $request;
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }
}
