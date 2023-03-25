<?php

use Http\Discovery\Exception\NotFoundException;
use OpenAI\Contracts\Transporter;
use OpenAI\Resources\Chat;
use OpenAI\Responses\Chat\CreateStreamedResponse;
use OpenAI\Responses\StreamResponse;
use Psr\Http\Message\ResponseInterface;

test('assertValidResponse throws NotFoundException on 404', function () {
    $model = 'model-do-not-exist';
    $statusCode = 404;

    $responseInterfaceMock = $this->createMock(ResponseInterface::class);
    $responseInterfaceMock->method('getStatusCode')->willReturn($statusCode);

    $streamResponse = new StreamResponse(CreateStreamedResponse::class, $responseInterfaceMock);

    $transporterMock = $this->createMock(Transporter::class);
    $chat = new Chat($transporterMock);

    $this->expectException(NotFoundException::class);
    $this->expectExceptionMessage(sprintf('Model "%s" not found', $model));

    $method = new \ReflectionMethod(Chat::class, 'assertValidResponse');
    $method->invoke($chat, $streamResponse, $model);
});

test('assertValidResponse does not throw exception on 200', function () {
    $model = 'gpt-3.5-turbo';
    $statusCode = 200;

    $responseInterfaceMock = $this->createMock(ResponseInterface::class);
    $responseInterfaceMock->method('getStatusCode')->willReturn($statusCode);

    $streamResponse = new StreamResponse(CreateStreamedResponse::class, $responseInterfaceMock);

    $transporterMock = $this->createMock(Transporter::class);
    $chat = new Chat($transporterMock);

    $method = new \ReflectionMethod(Chat::class, 'assertValidResponse');

    $this->assertNull($method->invoke($chat, $streamResponse, $model));
});
