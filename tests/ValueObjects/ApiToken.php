<?php

// Generate test for API token value object...

use OpenAI\ValueObjects\ApiToken;

it('can be created from a string', function () {
    $apiToken = ApiToken::from('foo');

    expect($apiToken->toString())->toBe('foo');
});
