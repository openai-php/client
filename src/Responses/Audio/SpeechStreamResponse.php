<?php

namespace OpenAI\Responses\Audio;

use Generator;
use Http\Discovery\Psr17Factory;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Contracts\ResponseStreamContract;
use OpenAI\Responses\Meta\MetaInformation;
use Psr\Http\Message\ResponseInterface;

/**
 * @implements ResponseStreamContract<string>
 */
final class SpeechStreamResponse implements ResponseHasMetaInformationContract, ResponseStreamContract
{
    public function __construct(
        private readonly ResponseInterface $response,
    ) {
        //
    }

    /**
     * {@inheritDoc}
     */
    public function getIterator(): Generator
    {
        while (! $this->response->getBody()->eof()) {
            yield $this->response->getBody()->read(1024);
        }
    }

    public function meta(): MetaInformation
    {
        return MetaInformation::from($this->response->getHeaders());
    }

    public static function fake(?string $content = null, ?MetaInformation $meta = null): static
    {
        $psr17Factory = new Psr17Factory;
        $response = $psr17Factory->createResponse()
            ->withBody($psr17Factory->createStream($content ?? (string) file_get_contents(__DIR__.'/../../Testing/Responses/Fixtures/Audio/speech-streamed.mp3')));

        if ($meta instanceof \OpenAI\Responses\Meta\MetaInformation) {
            foreach ($meta->toArray() as $key => $value) {
                if (is_scalar($value)) {
                    $response = $response->withHeader($key, (string) $value);
                }
            }
        }

        return new self($response);
    }
}
