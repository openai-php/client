<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\RealtimeContract;
use OpenAI\Responses\Responses\CreateResponse;
use OpenAI\Responses\Responses\ListInputItems;
use OpenAI\Responses\Responses\RetrieveResponse;

/**
 * @phpstan-import-type CreateResponseType from CreateResponse
 * @phpstan-import-type RetrieveResponseType from RetrieveResponse
 * @phpstan-import-type ListInputItemsType from ListInputItems
 */
final class Realtime implements RealtimeContract
{
    use Concerns\Streamable;
    use Concerns\Transportable;

    public function token(array $parameters = [])
    {
        // TODO: Implement token() method.
    }

    public function transcribeToken(array $parameters = [])
    {
        // TODO: Implement transcribeToken() method.
    }
}
