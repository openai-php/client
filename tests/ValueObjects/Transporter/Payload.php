<?php

use OpenAI\Enums\Transporter\ContentType;
use OpenAI\ValueObjects\ApiToken;
use OpenAI\ValueObjects\Transporter\BaseUri;
use OpenAI\ValueObjects\Transporter\Headers;
use OpenAI\ValueObjects\Transporter\Payload;

it('has a method', function () {
    $payload = Payload::create('models', []);

    $baseUri = BaseUri::from('api.openai.com/v1');
    $headers = Headers::withAuthorization(ApiToken::from('foo'))->withContentType(ContentType::JSON);

    expect($payload->toRequest($baseUri, $headers)->getMethod())->toBe('POST');
});

it('has a uri', function () {
    $payload = Payload::list('models');

    $baseUri = BaseUri::from('api.openai.com/v1');
    $headers = Headers::withAuthorization(ApiToken::from('foo'))->withContentType(ContentType::JSON);

    $uri = $payload->toRequest($baseUri, $headers)->getUri();

    expect($uri->getHost())->toBe('api.openai.com')
        ->and($uri->getScheme())->toBe('https')
        ->and($uri->getPath())->toBe('/v1/models');
});

test('get verb does not have a body', function () {
    $payload = Payload::list('models');

    $baseUri = BaseUri::from('api.openai.com/v1');
    $headers = Headers::withAuthorization(ApiToken::from('foo'))->withContentType(ContentType::JSON);

    expect($payload->toRequest($baseUri, $headers)->getBody()->getContents())->toBe('');
});

test('post verb has a body', function () {
    $payload = Payload::create('models', [
        'name' => 'test',
    ]);

    $baseUri = BaseUri::from('api.openai.com/v1');
    $headers = Headers::withAuthorization(ApiToken::from('foo'))->withContentType(ContentType::JSON);

    expect($payload->toRequest($baseUri, $headers)->getBody()->getContents())->toBe(json_encode([
        'name' => 'test',
    ]));
});
