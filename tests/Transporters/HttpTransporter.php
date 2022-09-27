<?php

use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\Request as Psr7Request;
use GuzzleHttp\Psr7\Response;
use OpenAI\Enums\Transporter\ContentType;
use OpenAI\Exceptions\ErrorException;
use OpenAI\Exceptions\TransporterException;
use OpenAI\Exceptions\UnserializableResponse;
use OpenAI\Transporters\HttpTransporter;
use OpenAI\ValueObjects\ApiToken;
use OpenAI\ValueObjects\Transporter\BaseUri;
use OpenAI\ValueObjects\Transporter\Headers;
use OpenAI\ValueObjects\Transporter\Payload;
use Psr\Http\Client\ClientInterface;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);

    $apiToken = ApiToken::from('foo');

    $this->http = new HttpTransporter(
        $this->client,
        BaseUri::from('api.openai.com/v1'),
        Headers::withAuthorization($apiToken)->withContentType(ContentType::JSON),
    );
});

test('request object', function () {
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

    $this->http->requestObject($payload);
});

test('request object response', function () {
    $payload = Payload::list('models');

    $response = new Response(200, [], json_encode([
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

test('request object server errors', function () {
    $payload = Payload::list('models');

    $response = new Response(401, [], json_encode([
        'error' => [
            'message' => 'Incorrect API key provided: foo. You can find your API key at https://beta.openai.com.',
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
            expect($e->getMessage())->toBe('Incorrect API key provided: foo. You can find your API key at https://beta.openai.com.')
                ->and($e->getErrorMessage())->toBe('Incorrect API key provided: foo. You can find your API key at https://beta.openai.com.')
                ->and($e->getErrorCode())->toBe('invalid_api_key')
                ->and($e->getErrorType())->toBe('invalid_request_error');
        });
});

test('request object client errors', function () {
    $payload = Payload::list('models');

    $baseUri = BaseUri::from('api.openai.com');
    $headers = Headers::withAuthorization(ApiToken::from('foo'));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andThrow(new ConnectException('Could not resolve host.', $payload->toRequest($baseUri, $headers)));

    expect(fn () => $this->http->requestObject($payload))->toThrow(function (TransporterException $e) {
        expect($e->getMessage())->toBe('Could not resolve host.')
            ->and($e->getCode())->toBe(0)
            ->and($e->getPrevious())->toBeInstanceOf(ConnectException::class);
    });
});

test('request object serialization errors', function () {
    $payload = Payload::list('models');

    $response = new Response(200, [], 'err');

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    $this->http->requestObject($payload);
})->throws(UnserializableResponse::class, 'Syntax error');

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
    $headers = Headers::withAuthorization(ApiToken::from('foo'));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andThrow(new ConnectException('Could not resolve host.', $payload->toRequest($baseUri, $headers)));

    expect(fn () => $this->http->requestContent($payload))->toThrow(function (TransporterException $e) {
        expect($e->getMessage())->toBe('Could not resolve host.')
            ->and($e->getCode())->toBe(0)
            ->and($e->getPrevious())->toBeInstanceOf(ConnectException::class);
    });
});

test('request content server errors', function () {
    $payload = Payload::list('models');

    $response = new Response(401, [], json_encode([
        'error' => [
            'message' => 'Incorrect API key provided: foo. You can find your API key at https://beta.openai.com.',
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
            expect($e->getMessage())->toBe('Incorrect API key provided: foo. You can find your API key at https://beta.openai.com.')
                ->and($e->getErrorMessage())->toBe('Incorrect API key provided: foo. You can find your API key at https://beta.openai.com.')
                ->and($e->getErrorCode())->toBe('invalid_api_key')
                ->and($e->getErrorType())->toBe('invalid_request_error');
        });
});
