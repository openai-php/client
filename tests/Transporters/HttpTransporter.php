<?php

use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\Request as Psr7Request;
use GuzzleHttp\Psr7\Response;
use OpenAI\Enums\Transporter\ContentType;
use OpenAI\Exceptions\ErrorException;
use OpenAI\Exceptions\TransporterException;
use OpenAI\Exceptions\UnserializableResponse;
use OpenAI\Transporters\HttpTransporter;
use OpenAI\ValueObjects\ApiKey;
use OpenAI\ValueObjects\Transporter\BaseUri;
use OpenAI\ValueObjects\Transporter\Headers;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\QueryParams;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);

    $apiKey = ApiKey::from('foo');

    $this->http = new HttpTransporter(
        $this->client,
        BaseUri::from('api.openai.com/v1'),
        Headers::withAuthorization($apiKey)->withContentType(ContentType::JSON),
        QueryParams::create()->withParam('foo', 'bar'),
        fn (RequestInterface $request): ResponseInterface => $this->client->sendAsyncRequest($request, ['stream' => true]),
    );
});

test('request object', function () {
    $payload = Payload::list('models');

    $response = new Response(200, ['Content-Type' => 'application/json; charset=utf-8'], json_encode([
        'qdwq',
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getMethod())->toBe('GET')
                ->and($request->getUri())
                ->getHost()->toBe('api.openai.com')
                ->getScheme()->toBe('https')
                ->getPath()->toBe('/v1/models');

            return true;
        })->andReturn($response);

    $this->http->requestObject($payload);
});

test('request object response', function () {
    $payload = Payload::list('models');

    $response = new Response(200, ['Content-Type' => 'application/json; charset=utf-8'], json_encode([
        [
            'text' => 'Hey!',
            'index' => 0,
            'logprobs' => null,
            'finish_reason' => 'length',
        ],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    $response = $this->http->requestObject($payload);

    expect($response)->toBe([
        [
            'text' => 'Hey!',
            'index' => 0,
            'logprobs' => null,
            'finish_reason' => 'length',
        ],
    ]);
});

test('request object server user errors', function () {
    $payload = Payload::list('models');

    $response = new Response(401, ['Content-Type' => 'application/json; charset=utf-8'], json_encode([
        'error' => [
            'message' => 'Incorrect API key provided: foo. You can find your API key at https://platform.openai.com.',
            'type' => 'invalid_request_error',
            'param' => null,
            'code' => 'invalid_api_key',
        ],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    expect(fn () => $this->http->requestObject($payload))
        ->toThrow(function (ErrorException $e) {
            expect($e->getMessage())->toBe('Incorrect API key provided: foo. You can find your API key at https://platform.openai.com.')
                ->and($e->getErrorMessage())->toBe('Incorrect API key provided: foo. You can find your API key at https://platform.openai.com.')
                ->and($e->getErrorCode())->toBe('invalid_api_key')
                ->and($e->getErrorType())->toBe('invalid_request_error');
        });
});

test('request object server errors', function () {
    $payload = Payload::create('completions', ['model' => 'gpt-4']);

    $response = new Response(401, ['Content-Type' => 'application/json'], json_encode([
        'error' => [
            'message' => 'That model is currently overloaded with other requests. You can ...',
            'type' => 'server_error',
            'param' => null,
            'code' => null,
        ],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    expect(fn () => $this->http->requestObject($payload))
        ->toThrow(function (ErrorException $e) {
            expect($e->getMessage())->toBe('That model is currently overloaded with other requests. You can ...')
                ->and($e->getErrorMessage())->toBe('That model is currently overloaded with other requests. You can ...')
                ->and($e->getErrorCode())->toBeNull()
                ->and($e->getErrorType())->toBe('server_error');
        });
});

test('error code may be null', function () {
    $payload = Payload::create('completions', ['model' => 'gpt-42']);

    $response = new Response(404, ['Content-Type' => 'application/json; charset=utf-8'], json_encode([
        'error' => [
            'message' => 'The model `gpt-42` does not exist',
            'type' => 'invalid_request_error',
            'param' => null,
            'code' => null,
        ],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    expect(fn () => $this->http->requestObject($payload))
        ->toThrow(function (ErrorException $e) {
            expect($e->getMessage())->toBe('The model `gpt-42` does not exist')
                ->and($e->getErrorMessage())->toBe('The model `gpt-42` does not exist')
                ->and($e->getErrorCode())->toBeNull()
                ->and($e->getErrorType())->toBe('invalid_request_error');
        });
});

test('error type may be null', function () {
    $payload = Payload::list('models');

    $response = new Response(429, ['Content-Type' => 'application/json; charset=utf-8'], json_encode([
        'error' => [
            'message' => 'You exceeded your current quota, please check',
            'type' => null,
            'param' => null,
            'code' => 'quota_exceeded',
        ],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    expect(fn () => $this->http->requestObject($payload))
        ->toThrow(function (ErrorException $e) {
            expect($e->getMessage())->toBe('You exceeded your current quota, please check')
                ->and($e->getErrorMessage())->toBe('You exceeded your current quota, please check')
                ->and($e->getErrorCode())->toBe('quota_exceeded')
                ->and($e->getErrorType())->toBeNull();
        });
});

test('error message may be an array', function () {
    $payload = Payload::create('completions', ['model' => 'gpt-4']);

    $response = new Response(404, ['Content-Type' => 'application/json; charset=utf-8'], json_encode([
        'error' => [
            'message' => [
                'Invalid schema for function \'get_current_weather\': In context=(\'properties\', \'location\'), array schema missing items',
            ],
            'type' => 'invalid_request_error',
            'param' => null,
            'code' => null,
        ],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    expect(fn () => $this->http->requestObject($payload))
        ->toThrow(function (ErrorException $e) {
            expect($e->getMessage())->toBe('Invalid schema for function \'get_current_weather\': In context=(\'properties\', \'location\'), array schema missing items')
                ->and($e->getErrorMessage())->toBe('Invalid schema for function \'get_current_weather\': In context=(\'properties\', \'location\'), array schema missing items')
                ->and($e->getErrorCode())->toBeNull()
                ->and($e->getErrorType())->toBe('invalid_request_error');
        });
});

test('error message may be empty', function () {
    $payload = Payload::create('completions', ['model' => 'gpt-4']);

    $response = new Response(404, ['Content-Type' => 'application/json; charset=utf-8'], json_encode([
        'error' => [
            'message' => '',
            'type' => 'invalid_request_error',
            'param' => null,
            'code' => 'invalid_api_key',
        ],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    expect(fn () => $this->http->requestObject($payload))
        ->toThrow(function (ErrorException $e) {
            expect($e->getMessage())->toBe('invalid_api_key')
                ->and($e->getErrorMessage())->toBe('invalid_api_key')
                ->and($e->getErrorCode())->toBe('invalid_api_key')
                ->and($e->getErrorType())->toBe('invalid_request_error');
        });
});

test('error message and code may be empty', function () {
    $payload = Payload::create('completions', ['model' => 'gpt-4']);

    $response = new Response(404, ['Content-Type' => 'application/json; charset=utf-8'], json_encode([
        'error' => [
            'message' => '',
            'type' => 'invalid_request_error',
            'param' => null,
            'code' => null,
        ],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    expect(fn () => $this->http->requestObject($payload))
        ->toThrow(function (ErrorException $e) {
            expect($e->getMessage())->toBe('Unknown error')
                ->and($e->getErrorMessage())->toBe('Unknown error')
                ->and($e->getErrorCode())->toBeNull()
                ->and($e->getErrorType())->toBe('invalid_request_error');
        });
});

test('request object client errors', function () {
    $payload = Payload::list('models');

    $baseUri = BaseUri::from('api.openai.com');
    $headers = Headers::withAuthorization(ApiKey::from('foo'));
    $queryParams = QueryParams::create();

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andThrow(new ConnectException('Could not resolve host.', $payload->toRequest($baseUri, $headers, $queryParams)));

    expect(fn () => $this->http->requestObject($payload))->toThrow(function (TransporterException $e) {
        expect($e->getMessage())->toBe('Could not resolve host.')
            ->and($e->getCode())->toBe(0)
            ->and($e->getPrevious())->toBeInstanceOf(ConnectException::class);
    });
});

test('request object serialization errors', function () {
    $payload = Payload::list('models');

    $response = new Response(200, ['Content-Type' => 'application/json; charset=utf-8'], 'err');

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    $this->http->requestObject($payload);
})->throws(UnserializableResponse::class, 'Syntax error');

test('request plain text', function () {
    $payload = Payload::upload('audio/transcriptions', []);

    $response = new Response(200, ['Content-Type' => 'text/plain; charset=utf-8'], 'Hello, how are you?');

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    $response = $this->http->requestObject($payload);

    expect($response)->toBe('Hello, how are you?');
});

test('request content', function () {
    $payload = Payload::list('models');

    $response = new Response(200, [], json_encode([
        'qdwq',
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getMethod())->toBe('GET')
                ->and($request->getUri())
                ->getHost()->toBe('api.openai.com')
                ->getScheme()->toBe('https')
                ->getPath()->toBe('/v1/models');

            return true;
        })->andReturn($response);

    $this->http->requestContent($payload);
});

test('request content response', function () {
    $payload = Payload::list('models');

    $response = new Response(200, [], 'My response content');

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    $response = $this->http->requestContent($payload);

    expect($response)->toBe('My response content');
});

test('request content client errors', function () {
    $payload = Payload::list('models');

    $baseUri = BaseUri::from('api.openai.com');
    $headers = Headers::withAuthorization(ApiKey::from('foo'));
    $queryParams = QueryParams::create();

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andThrow(new ConnectException('Could not resolve host.', $payload->toRequest($baseUri, $headers, $queryParams)));

    expect(fn () => $this->http->requestContent($payload))->toThrow(function (TransporterException $e) {
        expect($e->getMessage())->toBe('Could not resolve host.')
            ->and($e->getCode())->toBe(0)
            ->and($e->getPrevious())->toBeInstanceOf(ConnectException::class);
    });
});

test('request content server errors', function () {
    $payload = Payload::list('models');

    $response = new Response(401, ['Content-Type' => 'application/json; charset=utf-8'], json_encode([
        'error' => [
            'message' => 'Incorrect API key provided: foo. You can find your API key at https://platform.openai.com.',
            'type' => 'invalid_request_error',
            'param' => null,
            'code' => 'invalid_api_key',
        ],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    expect(fn () => $this->http->requestContent($payload))
        ->toThrow(function (ErrorException $e) {
            expect($e->getMessage())->toBe('Incorrect API key provided: foo. You can find your API key at https://platform.openai.com.')
                ->and($e->getErrorMessage())->toBe('Incorrect API key provided: foo. You can find your API key at https://platform.openai.com.')
                ->and($e->getErrorCode())->toBe('invalid_api_key')
                ->and($e->getErrorType())->toBe('invalid_request_error');
        });
});

test('request stream', function () {
    $payload = Payload::create('completions', []);

    $response = new Response(200, [], json_encode([
        'qdwq',
    ]));

    $this->client
        ->shouldReceive('sendAsyncRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getMethod())->toBe('POST')
                ->and($request->getUri())
                ->getHost()->toBe('api.openai.com')
                ->getScheme()->toBe('https')
                ->getPath()->toBe('/v1/completions');

            return true;
        })->andReturn($response);

    $response = $this->http->requestStream($payload);

    expect($response->getBody()->eof())
        ->toBeFalse();
});

test('request stream server errors', function () {
    $payload = Payload::create('completions', []);

    $response = new Response(401, ['Content-Type' => 'application/json; charset=utf-8'], json_encode([
        'error' => [
            'message' => 'Incorrect API key provided: foo. You can find your API key at https://platform.openai.com.',
            'type' => 'invalid_request_error',
            'param' => null,
            'code' => 'invalid_api_key',
        ],
    ]));

    $this->client
        ->shouldReceive('sendAsyncRequest')
        ->once()
        ->andReturn($response);

    expect(fn () => $this->http->requestStream($payload))
        ->toThrow(function (ErrorException $e) {
            expect($e->getMessage())->toBe('Incorrect API key provided: foo. You can find your API key at https://platform.openai.com.')
                ->and($e->getErrorMessage())->toBe('Incorrect API key provided: foo. You can find your API key at https://platform.openai.com.')
                ->and($e->getErrorCode())->toBe('invalid_api_key')
                ->and($e->getErrorType())->toBe('invalid_request_error');
        });
});
