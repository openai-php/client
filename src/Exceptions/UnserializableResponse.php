<?php

declare(strict_types=1);

namespace OpenAI\Exceptions;

use Exception;
use JsonException;

final class UnserializableResponse extends Exception
{
    private string $content;

    /**
     * Creates a new Exception instance.
     */
    public function __construct(JsonException $exception)
    {
        parent::__construct($exception->getMessage(), 0, $exception);
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }
}
