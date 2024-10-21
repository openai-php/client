<?php

namespace OpenAI\Exceptions;

class UnprocessableEntityError extends APIStatusError
{
    protected int $statusCode = 422;
}
