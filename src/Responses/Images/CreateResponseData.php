<?php

declare(strict_types=1);

namespace OpenAI\Responses\Images;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array{url: string, revised_prompt?: string}|array{b64_json: string, revised_prompt?: string}>
 */
final class CreateResponseData implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{url: string, revised_prompt?: string}|array{b64_json: string, revised_prompt?: string}>
     */
    use ArrayAccessible;

    private function __construct(
        public readonly string $url,
        public readonly string $b64_json,
        public readonly ?string $revisedPrompt,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{url?: string, b64_json?: string, revised_prompt?: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['url'] ?? '',
            $attributes['b64_json'] ?? '',
            $attributes['revised_prompt'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        $data = $this->url !== '' && $this->url !== '0' ?
            ['url' => $this->url] :
            ['b64_json' => $this->b64_json];

        if ($this->revisedPrompt !== null) {
            $data['revised_prompt'] = $this->revisedPrompt;
        }

        return $data;
    }
}
