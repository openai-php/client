<?php

use OpenAI\Testing\Responses\Fixtures\Decisions\CreateResponseFixture;

/**
 * @return array<string, mixed>
 */
function decisionResource(): array
{
    return CreateResponseFixture::ATTRIBUTES;
}
