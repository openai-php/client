<?php

declare(strict_types=1);

namespace OpenAI\Exceptions;

use Exception;
use Psr\Http\Message\RequestInterface;

final class TransporterException extends Exception
{
    private RequestInterface $request;

    /**
     * Creates a new Exception instance.
     */
    public function __construct(RequestInterface $request, string $message = '', int $code = 0)
    {
        parent::__construct($message, $code);
        $this->request = $request;
    }

    /**
     * Get the request that caused the exception.
     */
    public function getRequest(): RequestInterface
    {
        return $this->request;
    }
}
