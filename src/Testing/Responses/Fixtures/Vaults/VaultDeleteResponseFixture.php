<?php

namespace OpenAI\Testing\Responses\Fixtures\Vaults;

final class VaultDeleteResponseFixture
{
    public const ATTRIBUTES = [
        'id' => 'vault_abc123',
        'object' => 'vault.deleted',
        'deleted' => true,
    ];
}
