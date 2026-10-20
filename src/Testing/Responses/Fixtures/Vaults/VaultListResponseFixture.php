<?php

namespace OpenAI\Testing\Responses\Fixtures\Vaults;

final class VaultListResponseFixture
{
    public const ATTRIBUTES = [
        'object' => 'list',
        'data' => [
            VaultResponseFixture::ATTRIBUTES,
        ],
        'first_id' => 'vault_abc123',
        'last_id' => 'vault_abc123',
        'has_more' => false,
    ];
}
