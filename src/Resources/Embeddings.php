<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\ValueObjects\Transporter\Payload;

final class Embeddings
{
    use Concerns\Transportable;

    /**
     * Creates an embedding vector representing the input text.
     *
     * @see https://beta.openai.com/docs/api-reference/embeddings/create
     *
     * @param  array<string, mixed>  $parameters
     * @return array<string, array<string, mixed>|string>
     */
    public function create(array $parameters): array
    {
        $payload = Payload::create('embeddings', $parameters);

        /** @var array<string, array<string, mixed>|string> $result */
        $result = $this->transporter->request($payload);

        return $result;
    }
}
