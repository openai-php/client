<?php

namespace OpenAI\Exceptions;

class PermissionDeniedError extends APIStatusError
{
    protected int $statusCode = 403;
}
