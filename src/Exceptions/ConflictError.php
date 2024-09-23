<?php

namespace OpenAI\Exceptions;

class ConflictError extends APIStatusError
{
    protected int $statusCode = 409;
}
