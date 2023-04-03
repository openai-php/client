<?php

use OpenAI\Client;
use OpenAI\Contracts\TransporterContract;
use OpenAI\ValueObjects\ApiKey;
use OpenAI\ValueObjects\Transporter\BaseUri;
use OpenAI\ValueObjects\Transporter\Headers;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\QueryParams;
use Psr\Http\Message\ResponseInterface;

function mockClient(string $method, string $resource, array $params, array|string|ResponseInterface $response, $methodName = 'requestObject')
{
    $transporter = Mockery::mock(TransporterContract::class);

    $transporter
        ->shouldReceive($methodName)
        ->once()
        ->withArgs(function (Payload $payload) use ($method, $resource) {
            $baseUri = BaseUri::from('api.openai.com/v1');
            $headers = Headers::withAuthorization(ApiKey::from('foo'));
            $queryParams = QueryParams::create();

            $request = $payload->toRequest($baseUri, $headers, $queryParams);

            return $request->getMethod() === $method
                && $request->getUri()->getPath() === "/v1/$resource";
        })->andReturn($response);

    return new Client($transporter);
}

function mockContentClient(string $method, string $resource, array $params, string $response)
{
    return mockClient($method, $resource, $params, $response, 'requestContent');
}

function mockStreamClient(string $method, string $resource, array $params, ResponseInterface $response)
{
    return mockClient($method, $resource, $params, $response, 'requestStream');
}
