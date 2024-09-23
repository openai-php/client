<?php

namespace OpenAI\Exceptions;

class AuthenticationError extends APIStatusError
{
    protected int $statusCode = 401;
}
