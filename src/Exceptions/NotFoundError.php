<?php

namespace OpenAI\Exceptions;

class NotFoundError extends APIStatusError
{
    protected int $statusCode = 404;
}
