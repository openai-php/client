<?php

namespace OpenAI\Webhooks;

use DateTimeInterface;
use OpenAI\Exceptions\WebhookVerificationException;
use Psr\Http\Message\RequestInterface;
use RuntimeException;
use UnexpectedValueException;

readonly class WebhookSignatureVerifier
{
    private string $secret;

    /**
     * @throws UnexpectedValueException
     */
    public function __construct(
        string $secret,
        private int $tolerance = 300,
        string $secretPrefix = 'whsec_',
    ) {
        if (str_starts_with($secret, $secretPrefix)) {
            $secret = substr($secret, strlen($secretPrefix));
        }

        $this->secret = base64_decode($secret, true)
            ?: throw new UnexpectedValueException('Invalid secret format');
    }

    /**
     * @throws WebhookVerificationException|RuntimeException
     */
    public function verify(RequestInterface $request): void
    {
        $body = $request->getBody();
        $payload = $body->getContents();
        $body->rewind();

        $this->verifySignature($payload, [
            'webhook-id' => trim($request->getHeaderLine('webhook-id')) ?: null,
            'webhook-timestamp' => trim($request->getHeaderLine('webhook-timestamp')) ?: null,
            'webhook-signature' => trim($request->getHeaderLine('webhook-signature')) ?: null,
        ]);
    }

    /**
     * @param  array{webhook-id: ?non-falsy-string, webhook-timestamp: ?non-falsy-string, webhook-signature: ?non-falsy-string}  $headers
     *
     * @throws WebhookVerificationException
     */
    final protected function verifySignature(string $payload, array $headers): void
    {
        if (! isset($headers['webhook-id'], $headers['webhook-timestamp'], $headers['webhook-signature'])) {
            throw WebhookVerificationException::missingRequiredHeader();
        }

        [
            'webhook-id' => $messageId,
            'webhook-timestamp' => $messageTimestamp,
            'webhook-signature' => $messageSignature,
        ] = $headers;
        $timestamp = $this->verifyTimestamp($messageTimestamp);
        $signature = $this->sign($messageId, $timestamp, $payload);
        [, $expectedSignature] = explode(',', $signature, 2);
        $passedSignatures = explode(' ', $messageSignature);

        foreach ($passedSignatures as $versionedSignature) {
            [$version, $passedSignature] = explode(',', $versionedSignature, 2);

            if (strcmp($version, 'v1') !== 0) {
                continue;
            }

            if (hash_equals($expectedSignature, $passedSignature)) {
                return;
            }
        }

        throw WebhookVerificationException::noMatchingSignature();
    }

    /**
     * @throws WebhookVerificationException
     *
     * @internal
     */
    final public function sign(string $messageId, DateTimeInterface|int $timestamp, string $payload): string
    {
        $timestamp = match (true) {
            $timestamp instanceof DateTimeInterface => $timestamp->getTimestamp(),
            is_int($timestamp) && $timestamp > 0 => $timestamp,
            default => throw WebhookVerificationException::invalidTimestamp(),
        };

        $hash = hash_hmac(
            'sha256',
            implode('.', [$messageId, $timestamp, $payload]),
            $this->secret,
        );
        $signature = base64_encode(pack('H*', $hash));

        return 'v1,'.$signature;
    }

    /**
     * @throws WebhookVerificationException
     */
    protected function verifyTimestamp(string $timestampHeader): int
    {
        $now = time();
        $timestamp = (int) $timestampHeader;

        if ($timestamp < ($now - $this->tolerance)) {
            throw WebhookVerificationException::timestampMismatch();
        }

        if ($timestamp > ($now + $this->tolerance)) {
            throw WebhookVerificationException::timestampMismatch();
        }

        return $timestamp;
    }
}
