<?php

declare(strict_types=1);

namespace OpenAI\Exceptions;

use Exception;

final class UnknownTypeException extends Exception
{
    public function __construct(private string $unknownType)
    {
        parent::__construct('Unknown type: '.$this->unknownType);
    }

    public function getType(): string
    {
        return $this->unknownType;
    }
}
