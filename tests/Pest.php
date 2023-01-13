<?php

use GuzzleHttp\Psr7\Utils;
use OpenAI\Client;
use OpenAI\Contracts\Transporter;
use OpenAI\ValueObjects\ApiToken;
use OpenAI\ValueObjects\Transporter\BaseUri;
use OpenAI\ValueObjects\Transporter\Headers;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;
use Psr\Http\Message\ResponseInterface;

function mockClient(string $method, string $resource, array $params, array|string|Generator $response, $methodName = 'requestObject')
{
    $transporter = Mockery::mock(Transporter::class);
    $responseMock = null;

    if ($methodName === 'requestObject') {
        $responseMock = Mockery::mock(ResponseInterface::class);

        if (is_array($response) || is_string($response)) {
            $responseMock->shouldReceive('getBody')->andReturn(Utils::streamFor(
                is_array($response) ? json_encode($response) : $response
            ));
            $responseMock->shouldReceive('getHeaderLine')->andReturn('application/json');
        } elseif ($response instanceof Generator) {
            $responseMock->shouldReceive('getBody')->andReturn(Utils::streamFor(
                'data: '.implode("\n\ndata: ", array_map(
                    fn ($value) => json_encode($value),
                    iterator_to_array($response)
                )
                )));

            $responseMock->shouldReceive('getHeaderLine')->andReturn('text/event-stream');
        }
    }

    $transporter
        ->shouldReceive($methodName)
        ->once()
        ->withArgs(function (Payload $payload) use ($method, $resource) {
            $baseUri = BaseUri::from('api.openai.com/v1');
            $headers = Headers::withAuthorization(ApiToken::from('foo'));

            $request = $payload->toRequest($baseUri, $headers);

            return $request->getMethod() === $method
                && $request->getUri()->getPath() === "/v1/$resource";
        })->andReturn($responseMock ? new Response($responseMock) : $response);

    return new Client($transporter);
}

function mockContentClient(string $method, string $resource, array $params, string $response)
{
    return mockClient($method, $resource, $params, $response, 'requestContent');
}
