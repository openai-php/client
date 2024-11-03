<?php

namespace OpenAI\Exceptions;

class RateLimitError extends APIStatusError
{
    protected int $statusCode = 429;
}
