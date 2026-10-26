<?php

use OpenAI\Enums\Transporter\ContentType;
use OpenAI\ValueObjects\ApiKey;
use OpenAI\ValueObjects\Transporter\BaseUri;
use OpenAI\ValueObjects\Transporter\Headers;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\QueryParams;

it('has a method', function () {
    $payload = Payload::create('models', []);

    $baseUri = BaseUri::from('api.openai.com/v1');
    $headers = Headers::withAuthorization(ApiKey::from('foo'))->withContentType(ContentType::JSON);
    $queryParams = QueryParams::create();

    expect($payload->toRequest($baseUri, $headers, $queryParams)->getMethod())->toBe('POST');
});

it('has a uri', function () {
    $payload = Payload::list('models');

    $baseUri = BaseUri::from('api.openai.com/v1');
    $headers = Headers::withAuthorization(ApiKey::from('foo'))->withContentType(ContentType::JSON);
    $queryParams = QueryParams::create()
        ->withParam('foo', 'bar')
        ->withParam('baz', 'qux');

    $uri = $payload->toRequest($baseUri, $headers, $queryParams)->getUri();

    expect($uri->getHost())->toBe('api.openai.com')
        ->and($uri->getScheme())->toBe('https')
        ->and($uri->getPath())->toBe('/v1/models')
        ->and($uri->getQuery())->toBe('foo=bar&baz=qux');
});

test('get verb does not have a body', function () {
    $payload = Payload::list('models');

    $baseUri = BaseUri::from('api.openai.com/v1');
    $headers = Headers::withAuthorization(ApiKey::from('foo'))->withContentType(ContentType::JSON);
    $queryParams = QueryParams::create();

    expect($payload->toRequest($baseUri, $headers, $queryParams)->getBody()->getContents())->toBe('');
});

test('post verb has a body', function () {
    $payload = Payload::create('models', [
        'name' => 'test',
    ]);

    $baseUri = BaseUri::from('api.openai.com/v1');
    $headers = Headers::withAuthorization(ApiKey::from('foo'))->withContentType(ContentType::JSON);
    $queryParams = QueryParams::create();

    expect($payload->toRequest($baseUri, $headers, $queryParams)->getBody()->getContents())->toBe(json_encode([
        'name' => 'test',
    ]));
});

test('builds upload request', function () {
    $payload = Payload::upload('files', [
        'purpose' => 'fine-tune',
        'file' => fileResourceResource(),
    ]);

    $baseUri = BaseUri::from('api.openai.com/v1');
    $headers = Headers::withAuthorization(ApiKey::from('foo'));
    $queryParams = QueryParams::create();

    $request = $payload->toRequest($baseUri, $headers, $queryParams);

    expect($request->getHeader('Content-Type')[0])
        ->toMatch('/multipart\/form-data; boundary=.+/');

    expect($request->getBody()->getContents())
        ->toContain('Content-Disposition: form-data; name="purpose"')
        ->toContain('Content-Disposition: form-data; name="file"; filename="MyFile.jsonl"')
        ->toContain('{"prompt": "<prompt text>", "completion": "<ideal generated text>"}');
});

test('builds upload request with nested parameters', function () {
    $payload = Payload::upload('files', [
        'purpose' => 'fine-tune',
        'file' => fileResourceResource(),
        'expires_after' => [
            'anchor' => 'created_at',
            'seconds' => 2592000,
        ],
    ]);

    $baseUri = BaseUri::from('api.openai.com/v1');
    $headers = Headers::withAuthorization(ApiKey::from('foo'));
    $queryParams = QueryParams::create();

    $request = $payload->toRequest($baseUri, $headers, $queryParams);

    expect($request->getBody()->getContents())
        ->toContain("Content-Disposition: form-data; name=\"expires_after[anchor]\"\r\n\r\ncreated_at\r\n")
        ->toContain("Content-Disposition: form-data; name=\"expires_after[seconds]\"\r\n\r\n2592000\r\n");
});

test('builds upload request with list parameters', function () {
    $payload = Payload::upload('audio/transcriptions', [
        'file' => fileResourceResource(),
        'model' => 'whisper-1',
        'timestamp_granularities' => ['word', 'segment'],
    ]);

    $baseUri = BaseUri::from('api.openai.com/v1');
    $headers = Headers::withAuthorization(ApiKey::from('foo'));
    $queryParams = QueryParams::create();

    $request = $payload->toRequest($baseUri, $headers, $queryParams);

    expect($request->getBody()->getContents())
        ->toContain("Content-Disposition: form-data; name=\"timestamp_granularities[]\"\r\n\r\nword\r\n")
        ->toContain("Content-Disposition: form-data; name=\"timestamp_granularities[]\"\r\n\r\nsegment\r\n");
});

test('builds upload request with files keyed by name', function () {
    $payload = Payload::upload('skills', [
        'files' => ['SKILL.md' => fileResourceResource(), 'calculate.py' => fileResourceResource()],
    ]);

    $baseUri = BaseUri::from('api.openai.com/v1');
    $headers = Headers::withAuthorization(ApiKey::from('foo'));
    $queryParams = QueryParams::create();

    $request = $payload->toRequest($baseUri, $headers, $queryParams);

    expect($request->getBody()->getContents())
        ->toContain('Content-Disposition: form-data; name="files[]"; filename="MyFile.jsonl"')
        ->not->toContain('files[SKILL.md]');
});

test('with header sends the header with the request', function () {
    $payload = Payload::list('agents')->withHeader('OpenAI-Beta', 'agents=v1');

    $baseUri = BaseUri::from('api.openai.com/v1');
    $headers = Headers::withAuthorization(ApiKey::from('foo'));
    $queryParams = QueryParams::create();

    $request = $payload->toRequest($baseUri, $headers, $queryParams);

    expect($request->getHeaderLine('OpenAI-Beta'))->toBe('agents=v1')
        ->and($request->getHeaderLine('Authorization'))->toBe('Bearer foo');
});

test('with header leaves the original payload unchanged', function () {
    $payload = Payload::list('agents');
    $payload->withHeader('OpenAI-Beta', 'agents=v1');

    $request = $payload->toRequest(BaseUri::from('api.openai.com/v1'), Headers::withAuthorization(ApiKey::from('foo')), QueryParams::create());

    expect($request->hasHeader('OpenAI-Beta'))->toBeFalse();
});

test('with header takes priority over a client header with the same name', function () {
    $payload = Payload::list('agents')->withHeader('OpenAI-Beta', 'agents=v1');

    $headers = Headers::withAuthorization(ApiKey::from('foo'))->withCustomHeader('OpenAI-Beta', 'assistants=v2');

    $request = $payload->toRequest(BaseUri::from('api.openai.com/v1'), $headers, QueryParams::create());

    expect($request->getHeaderLine('OpenAI-Beta'))->toBe('agents=v1');
});
