<?php

declare(strict_types=1);

namespace OpenAI\Exceptions;

use Exception;
use JsonException;
use Psr\Http\Message\ResponseInterface;

final class UnserializableResponse extends Exception
{
    public function __construct(JsonException $exception, public ResponseInterface $response)
    {
        parent::__construct($exception->getMessage() . ' or the server returned an invalid response.', 0, $exception);
    }
}
