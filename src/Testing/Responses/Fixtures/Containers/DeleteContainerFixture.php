<?php

namespace OpenAI\Testing\Responses\Fixtures\Containers;

final class DeleteContainerFixture
{
    public const ATTRIBUTES = [
        'id' => 'container_abc123',
        'object' => 'container',
        'deleted' => true,
    ];
}
