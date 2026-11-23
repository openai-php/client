<?php

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use OpenAI\Client;
use OpenAI\Exceptions\ErrorException;

dataset('raw response methods', [
    'speech' => [static fn (Client $client): string => $client->audio()->speech(['model' => 'tts-1', 'voice' => 'alloy', 'input' => 'Hello'])],
    'file download' => [static fn (Client $client): string => $client->files()->download('file_test')],
    'container file content' => [static fn (Client $client): string => $client->containers()->files()->content('cntr_test', 'cfile_test')],
    'skill content' => [static fn (Client $client): string => $client->skills()->content('skill_test')],
    'skill version content' => [static fn (Client $client): string => $client->skills()->versions()->content('skill_test', '1')],
    'agent session event' => [static function (Client $client): void {
        $client->agents()->sessions()->events()->create('session_test', ['type' => 'session.cancel']);
    }],
]);

test('raw response methods reject HTTP errors without an OpenAI error payload', function (Closure $call, Response $response) {
    $handler = HandlerStack::create(new MockHandler([$response]));
    $client = OpenAI::factory()->withApiKey('test-key')->withHttpClient(new HttpClient(['handler' => $handler]))->make();

    expect(fn () => $call($client))->toThrow(function (ErrorException $exception) use ($response) {
        expect($exception->getStatusCode())->toBe($response->getStatusCode())
            ->and($exception->response->getHeaderLine('x-request-id'))->toBe('req_raw');
    });
})->with('raw response methods')->with([
    'HTML forbidden' => [new Response(403, ['Content-Type' => 'text/html', 'x-request-id' => 'req_raw'], '<html>Forbidden</html>')],
    'empty not found' => [new Response(404, ['x-request-id' => 'req_raw'])],
]);

test('successful speech returns the original audio bytes', function () {
    $bytes = "ID3\x00\xff";
    $handler = HandlerStack::create(new MockHandler([new Response(200, ['Content-Type' => 'audio/mpeg'], $bytes)]));
    $client = OpenAI::factory()->withApiKey('test-key')->withHttpClient(new HttpClient(['handler' => $handler]))->make();

    expect($client->audio()->speech(['model' => 'tts-1', 'voice' => 'alloy', 'input' => 'Hello']))->toBe($bytes);
});

test('an agent session event accepts a successful empty response', function () {
    $handler = HandlerStack::create(new MockHandler([new Response(204)]));
    $client = OpenAI::factory()->withApiKey('test-key')->withHttpClient(new HttpClient(['handler' => $handler]))->make();

    expect($client->agents()->sessions()->events()->create('session_test', ['type' => 'session.cancel']))->toBeNull();
});
