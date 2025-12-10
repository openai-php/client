<?php

use Http\Discovery\Psr17Factory;
use OpenAI\Exceptions\WebhookVerificationException;
use OpenAI\Webhooks\WebhookSignatureVerifier;
use Psr\Http\Message\ServerRequestInterface;

it('should handle valid signatures', function () {
    $secret = 'whsec_MfKQ9r8GKYqrTwjUPD8ILPZIo2LaLaSw';
    $messageId = 'msg_2KWPBgLlAfxdpx2AI54pPJ85f4W';
    $timestamp = time();
    $payload = '{"foo":"bar"}';

    $verifier = new WebhookSignatureVerifier($secret);
    $signature = $verifier->sign($messageId, $timestamp, $payload);
    $request = createWebhookRequest([
        'webhook-id' => $messageId,
        'webhook-timestamp' => $timestamp,
        'webhook-signature' => $signature,
    ], $payload);

    expect(static fn () => $verifier->verify($request))
        ->not->toThrow(
            WebhookVerificationException::class,
            message: 'Valid signature should not cause an exception',
        );
});

it('should bail on invalid signatures', function () {
    $secret = 'whsec_MfKQ9r8GKYqrTwjUPD8ILPZIo2LaLaSw';
    $messageId = 'msg_2KWPBgLlAfxdpx2AI54pPJ85f4W';
    $timestamp = time();
    $payload = '{"foo":"bar"}';

    $verifier = new WebhookSignatureVerifier($secret);
    $request = createWebhookRequest([
        'webhook-id' => $messageId,
        'webhook-timestamp' => $timestamp,
        'webhook-signature' => 'v1,dawfeoifkpqwoekfpqoekf',
    ], $payload);

    expect(static fn () => $verifier->verify($request))
        ->toThrow(
            WebhookVerificationException::class,
            'No matching signature found',
            'Invalid signature should cause an exception',
        );
});

it('should bail on missing webhook-id header', function () {
    $secret = 'whsec_MfKQ9r8GKYqrTwjUPD8ILPZIo2LaLaSw';
    $messageId = 'msg_2KWPBgLlAfxdpx2AI54pPJ85f4W';
    $timestamp = time();
    $payload = '{"foo":"bar"}';

    $verifier = new WebhookSignatureVerifier($secret);
    $signature = $verifier->sign($messageId, $timestamp, $payload);
    $request = createWebhookRequest([
        'webhook-timestamp' => $timestamp,
        'webhook-signature' => $signature,
    ], $payload);

    expect(static fn () => $verifier->verify($request))
        ->toThrow(
            WebhookVerificationException::class,
            'Missing required header',
            'Missing message ID header should cause an exception',
        );
});

it('should bail on missing webhook-timestamp header', function () {
    $secret = 'whsec_MfKQ9r8GKYqrTwjUPD8ILPZIo2LaLaSw';
    $messageId = 'msg_2KWPBgLlAfxdpx2AI54pPJ85f4W';
    $timestamp = time();
    $payload = '{"foo":"bar"}';

    $verifier = new WebhookSignatureVerifier($secret);
    $signature = $verifier->sign($messageId, $timestamp, $payload);
    $request = createWebhookRequest([
        'webhook-id' => $messageId,
        'webhook-signature' => $signature,
    ], $payload);

    expect(static fn () => $verifier->verify($request))
        ->toThrow(
            WebhookVerificationException::class,
            'Missing required header',
            'Missing timestamp header should cause an exception',
        );
});

it('should bail on missing webhook-signature header', function () {
    $secret = 'whsec_MfKQ9r8GKYqrTwjUPD8ILPZIo2LaLaSw';
    $messageId = 'msg_2KWPBgLlAfxdpx2AI54pPJ85f4W';
    $timestamp = time();
    $payload = '{"foo":"bar"}';

    $verifier = new WebhookSignatureVerifier($secret);
    $request = createWebhookRequest([
        'webhook-id' => $messageId,
        'webhook-timestamp' => $timestamp,
    ], $payload);

    expect(static fn () => $verifier->verify($request))
        ->toThrow(
            WebhookVerificationException::class,
            'Missing required header',
            'Missing signature header should cause an exception',
        );
});

it('should bail on past timestamp', function () {
    $secret = 'whsec_MfKQ9r8GKYqrTwjUPD8ILPZIo2LaLaSw';
    $messageId = 'msg_2KWPBgLlAfxdpx2AI54pPJ85f4W';
    $timestamp = time() - 200;
    $payload = '{"foo":"bar"}';

    $verifier = new WebhookSignatureVerifier($secret, 100);
    $signature = $verifier->sign($messageId, $timestamp, $payload);
    $request = createWebhookRequest([
        'webhook-id' => $messageId,
        'webhook-timestamp' => $timestamp,
        'webhook-signature' => $signature,
    ], $payload);

    expect(static fn () => $verifier->verify($request))
        ->toThrow(
            WebhookVerificationException::class,
            'Message timestamp outside tolerance window',
            'Too old timestamp should cause an exception',
        );
});

it('should bail on future timestamp', function () {
    $secret = 'whsec_MfKQ9r8GKYqrTwjUPD8ILPZIo2LaLaSw';
    $messageId = 'msg_2KWPBgLlAfxdpx2AI54pPJ85f4W';
    $timestamp = time() + 200;
    $payload = '{"foo":"bar"}';

    $verifier = new WebhookSignatureVerifier($secret, 100);
    $signature = $verifier->sign($messageId, $timestamp, $payload);
    $request = createWebhookRequest([
        'webhook-id' => $messageId,
        'webhook-timestamp' => $timestamp,
        'webhook-signature' => $signature,
    ], $payload);

    expect(static fn () => $verifier->verify($request))
        ->toThrow(
            WebhookVerificationException::class,
            'Message timestamp outside tolerance window',
            'Too new timestamp should cause an exception',
        );
});

it('should handle multiple signatures', function () {
    $secret = 'whsec_MfKQ9r8GKYqrTwjUPD8ILPZIo2LaLaSw';
    $messageId = 'msg_2KWPBgLlAfxdpx2AI54pPJ85f4W';
    $timestamp = time();
    $payload = '{"foo":"bar"}';

    $verifier = new WebhookSignatureVerifier($secret);
    $signature = $verifier->sign($messageId, $timestamp, $payload);
    $request = createWebhookRequest([
        'webhook-id' => $messageId,
        'webhook-timestamp' => $timestamp,
        'webhook-signature' => implode(' ', [
            'v1,Ceo5qEr07ixe2NLpvHk3FH9bwy/WavXrAFQ/9tdO6mc=',
            'v2,Ceo5qEr07ixe2NLpvHk3FH9bwy/WavXrAFQ/9tdO6mc=',
            $signature,
            'v1a,hnO3f9T8Ytu9HwrXslvumlUpqtNVqkhqw/enGzPCXe5BdqzCInXqYXFymVJaA7AZdpXwVLPo3mNl8EM+m7TBAg==',
            'v1,K5oZfzN95Z9UVu1EsfQmfVNQhnkZ2pj9o9NDN/H/pI4=',
        ]),
    ], $payload);

    expect(static fn () => $verifier->verify($request))
        ->not->toThrow(
            WebhookVerificationException::class,
            message: 'One of the signatures should be accepted',
        );
});

it('should handle secret prefixes', function () {
    $secret = 'MfKQ9r8GKYqrTwjUPD8ILPZIo2LaLaSw';
    $messageId = 'msg_2KWPBgLlAfxdpx2AI54pPJ85f4W';
    $timestamp = time();
    $payload = '{"foo":"bar"}';

    $defaultVerifier = new WebhookSignatureVerifier($secret);
    $prefixVerifier = new WebhookSignatureVerifier('whsec_'.$secret);
    $customPrefixVerifier = new WebhookSignatureVerifier('foobar_'.$secret, secretPrefix: 'foobar_');
    $signature = $defaultVerifier->sign($messageId, $timestamp, $payload);
    $request = createWebhookRequest([
        'webhook-id' => $messageId,
        'webhook-timestamp' => $timestamp,
        'webhook-signature' => $signature,
    ], $payload);

    expect(static fn () => $defaultVerifier->verify($request))
        ->not
        ->toThrow(
            WebhookVerificationException::class,
            message: 'Verifier configured without prefix should accept the signature',
        )
        ->and(static fn () => $prefixVerifier->verify($request))
        ->not
        ->toThrow(
            WebhookVerificationException::class,
            message: 'Verifier configured with prefix should accept the signature',
        )
        ->and(static fn () => $customPrefixVerifier->verify($request))
        ->not
        ->toThrow(
            WebhookVerificationException::class,
            message: 'Verifier configured with custom prefix should accept the signature',
        );
});

/**
 * @throws InvalidArgumentException
 */
function createWebhookRequest(array $headers, ?string $payload = null): ServerRequestInterface
{
    $factory = new Psr17Factory;
    $request = $factory->createServerRequest('POST', '/webhook');

    foreach ($headers as $name => $value) {
        $request = $request->withHeader($name, $value);
    }

    if ($payload !== null) {
        $request = $request->withBody($factory->createStream($payload));
    }

    return $request;
}
