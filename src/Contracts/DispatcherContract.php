<?php

declare(strict_types=1);

namespace OpenAI\Contracts;

use OpenAI\Exceptions\ErrorException;
use OpenAI\Exceptions\TransporterException;
use OpenAI\Exceptions\UnserializableResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;
use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 */
interface DispatcherContract
{
    /**
     * Dispatch an event.
     */
    public function dispatch(object $event): void;
}
