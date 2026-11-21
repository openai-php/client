<?php

declare(strict_types=1);

namespace OpenAI\Responses\Live\Sessions;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type SessionType array{id: string}
 * @phpstan-type TransportType array{type: 'sip'}|array{type: 'webrtc', sdp: string}
 * @phpstan-type CreateResponseType array{session: SessionType, transport: TransportType}
 *
 * @implements ResponseContract<CreateResponseType>
 */
final class CreateResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /** @use ArrayAccessible<CreateResponseType> */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  SessionType  $session
     * @param  TransportType  $transport
     */
    private function __construct(
        public readonly array $session,
        public readonly array $transport,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  CreateResponseType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self($attributes['session'], $attributes['transport'], $meta);
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'session' => $this->session,
            'transport' => $this->transport,
        ];
    }
}
