<?php

namespace OpenAI\Responses\Meta;

use OpenAI\Contracts\MetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements MetaInformationContract<array{x-request-id?: string, openai-model?: string, openai-organization?: string, openai-project?: string, openai-processing-ms?: int, openai-version?: string, x-ratelimit-limit-requests?: int, x-ratelimit-limit-tokens?: int, x-ratelimit-remaining-requests?: int, x-ratelimit-remaining-tokens?: int, x-ratelimit-reset-requests?: string, x-ratelimit-reset-tokens?: string, custom?: array<string, string>}>
 */
final class MetaInformation implements MetaInformationContract
{
    /**
     * @use ArrayAccessible<array{x-request-id?: string, openai-model?: string, openai-organization?: string, openai-project?: string, openai-processing-ms?: int, openai-version?: string, x-ratelimit-limit-requests?: int, x-ratelimit-limit-tokens?: int, x-ratelimit-remaining-requests?: int, x-ratelimit-remaining-tokens?: int, x-ratelimit-reset-requests?: string, x-ratelimit-reset-tokens?: string, custom?: array<string, string>}>
     */
    use ArrayAccessible;

    private function __construct(
        public ?string $requestId,
        public readonly MetaInformationOpenAI $openai,
        public readonly ?MetaInformationRateLimit $requestLimit,
        public readonly ?MetaInformationRateLimit $tokenLimit,
        public readonly MetaInformationCustom $custom,
    ) {}

    /**
     * @param  array<string, array<int, string>>  $headers
     */
    public static function from(array $headers): self
    {
        $knownHeaders = [
            'x-request-id',
            'openai-model',
            'openai-organization',
            'openai-project',
            'openai-version',
            'openai-processing-ms',
            'x-ratelimit-limit-requests',
            'x-ratelimit-remaining-requests',
            'x-ratelimit-reset-requests',
            'x-ratelimit-limit-tokens',
            'x-ratelimit-remaining-tokens',
            'x-ratelimit-reset-tokens',
        ];

        $headers = array_change_key_case($headers, CASE_LOWER);

        $requestId = $headers['x-request-id'][0] ?? null;

        $openai = MetaInformationOpenAI::from([
            'model' => $headers['openai-model'][0] ?? null,
            'organization' => $headers['openai-organization'][0] ?? null,
            'project' => $headers['openai-project'][0] ?? null,
            'version' => $headers['openai-version'][0] ?? null,
            'processingMs' => isset($headers['openai-processing-ms'][0]) ? (int) $headers['openai-processing-ms'][0] : null,
        ]);

        if (isset($headers['x-ratelimit-remaining-requests'][0])) {
            $requestLimit = MetaInformationRateLimit::from([
                'limit' => isset($headers['x-ratelimit-limit-requests'][0]) ? (int) $headers['x-ratelimit-limit-requests'][0] : null,
                'remaining' => (int) $headers['x-ratelimit-remaining-requests'][0],
                'reset' => $headers['x-ratelimit-reset-requests'][0] ?? null,
            ]);
        } else {
            $requestLimit = null;
        }

        if (isset($headers['x-ratelimit-remaining-tokens'][0])) {
            $tokenLimit = MetaInformationRateLimit::from([
                'limit' => isset($headers['x-ratelimit-limit-tokens'][0]) ? (int) $headers['x-ratelimit-limit-tokens'][0] : null,
                'remaining' => (int) $headers['x-ratelimit-remaining-tokens'][0],
                'reset' => $headers['x-ratelimit-reset-tokens'][0] ?? null,
            ]);
        } else {
            $tokenLimit = null;
        }

        $customHeaders = [];
        foreach ($headers as $name => $values) {
            if (in_array($name, $knownHeaders, true)) {
                continue;
            }

            $customHeaders[$name] = $values[0] ?? null;
        }

        $custom = MetaInformationCustom::from($customHeaders);

        return new self(
            $requestId,
            $openai,
            $requestLimit,
            $tokenLimit,
            $custom,
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
            'openai-project' => $this->openai->project,
            'openai-processing-ms' => $this->openai->processingMs,
            'openai-version' => $this->openai->version,
            'x-ratelimit-limit-requests' => $this->requestLimit->limit ?? null,
            'x-ratelimit-limit-tokens' => $this->tokenLimit->limit ?? null,
            'x-ratelimit-remaining-requests' => $this->requestLimit->remaining ?? null,
            'x-ratelimit-remaining-tokens' => $this->tokenLimit->remaining ?? null,
            'x-ratelimit-reset-requests' => $this->requestLimit->reset ?? null,
            'x-ratelimit-reset-tokens' => $this->tokenLimit->reset ?? null,
            'x-request-id' => $this->requestId,
            'custom' => ! $this->custom->isEmpty() ? $this->custom->toArray() : null,
        ], fn (array|string|int|null $value): bool => ! is_null($value));
    }
}
