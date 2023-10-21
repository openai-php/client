<?php

namespace OpenAI\Responses\Meta;

use OpenAI\Contracts\MetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements MetaInformationContract<array{x-request-id: string, openai-model?: string, openai-organization?: string, openai-processing-ms?: int, openai-version?: string, x-ratelimit-limit-requests?: int, x-ratelimit-limit-tokens?: int, x-ratelimit-remaining-requests?: int, x-ratelimit-remaining-tokens?: int, x-ratelimit-reset-requests?: string, x-ratelimit-reset-tokens?: string, x-request-id: string}>
 */
final class MetaInformation implements MetaInformationContract
{
    /**
     * @use ArrayAccessible<array{x-request-id: string, openai-model?: string, openai-organization?: string, openai-processing-ms?: int, openai-version?: string, x-ratelimit-limit-requests?: int, x-ratelimit-limit-tokens?: int, x-ratelimit-remaining-requests?: int, x-ratelimit-remaining-tokens?: int, x-ratelimit-reset-requests?: string, x-ratelimit-reset-tokens?: string, x-request-id: string}>
     */
    use ArrayAccessible;

    private function __construct(
        public string $requestId,
        public readonly MetaInformationOpenAI $openai,
        public readonly ?MetaInformationRateLimit $requestLimit,
        public readonly ?MetaInformationRateLimit $tokenLimit,
    ) {
    }

    /**
     * @param  array{x-request-id: string[], openai-model: string[], openai-organization: string[], openai-version: string[], openai-processing-ms: string[], x-ratelimit-limit-requests: string[], x-ratelimit-remaining-requests: string[], x-ratelimit-reset-requests: string[], x-ratelimit-limit-tokens: string[], x-ratelimit-remaining-tokens: string[], x-ratelimit-reset-tokens: string[]}  $headers
     */
    public static function from(array $headers): self
    {
        $requestId = $headers['x-request-id'][0];

        $openai = MetaInformationOpenAI::from([
            'model' => $headers['openai-model'][0] ?? null,
            'organization' => $headers['openai-organization'][0] ?? null,
            'version' => $headers['openai-version'][0] ?? null,
            'processingMs' => isset($headers['openai-processing-ms'][0]) ? (int) $headers['openai-processing-ms'][0] : null,
        ]);

        if (isset($headers['x-ratelimit-limit-requests'][0])) {
            $requestLimit = MetaInformationRateLimit::from([
                'limit' => (int) $headers['x-ratelimit-limit-requests'][0],
                'remaining' => (int) $headers['x-ratelimit-remaining-requests'][0],
                'reset' => $headers['x-ratelimit-reset-requests'][0],
            ]);
        } else {
            $requestLimit = null;
        }

        if (isset($headers['x-ratelimit-limit-tokens'][0])) {
            $tokenLimit = MetaInformationRateLimit::from([
                'limit' => (int) $headers['x-ratelimit-limit-tokens'][0],
                'remaining' => (int) $headers['x-ratelimit-remaining-tokens'][0],
                'reset' => $headers['x-ratelimit-reset-tokens'][0],
            ]);
        } else {
            $tokenLimit = null;
        }

        return new self(
            $requestId,
            $openai,
            $requestLimit,
            $tokenLimit,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return array_filter([
            'openai-model' => $this->openai->model,
            'openai-organization' => $this->openai->organization,
            'openai-processing-ms' => $this->openai->processingMs,
            'openai-version' => $this->openai->version,
            'x-ratelimit-limit-requests' => $this->requestLimit->limit ?? null,
            'x-ratelimit-limit-tokens' => $this->tokenLimit->limit ?? null,
            'x-ratelimit-remaining-requests' => $this->requestLimit->remaining ?? null,
            'x-ratelimit-remaining-tokens' => $this->tokenLimit->remaining ?? null,
            'x-ratelimit-reset-requests' => $this->requestLimit->reset ?? null,
            'x-ratelimit-reset-tokens' => $this->tokenLimit->reset ?? null,
            'x-request-id' => $this->requestId,
        ], fn (string|int|null $value): bool => ! is_null($value));
    }
}
