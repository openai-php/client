<?php

namespace OpenAI\Exceptions;

class BadRequestError extends APIStatusError
{
    protected int $statusCode = 400;
}
