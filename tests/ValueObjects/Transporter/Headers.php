<?php

use OpenAI\Enums\Transporter\ContentType;
use OpenAI\ValueObjects\ApiToken;
use OpenAI\ValueObjects\Transporter\Headers;

it('can be created from an API Token', function () {
    $headers = Headers::withAuthorization(ApiToken::from('foo'));

    expect($headers->toArray())->toBe([
        'Authorization' => 'Bearer foo',
    ]);
});

it('can have content/type', function () {
    $headers = Headers::withAuthorization(ApiToken::from('foo'))
        ->withContentType(ContentType::JSON);

    expect($headers->toArray())->toBe([
        'Authorization' => 'Bearer foo',
        'Content-Type' => 'application/json',
    ]);
});

it('can have organization', function () {
    $headers = Headers::withAuthorization(ApiToken::from('foo'))
        ->withContentType(ContentType::JSON)
        ->withOrganization('nunomaduro');

    expect($headers->toArray())->toBe([
        'Authorization' => 'Bearer foo',
        'Content-Type' => 'application/json',
        'OpenAI-Organization' => 'nunomaduro',
    ]);
});
