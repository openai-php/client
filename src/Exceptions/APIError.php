<?php

namespace OpenAI\Exceptions;

use Psr\Http\Message\RequestInterface;

class APIError extends ErrorException
{
    public function __construct(protected readonly RequestInterface $request, array $contents)
    {
        parent::__construct($contents);
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }
}
