<?php

namespace OpenAI\Testing\Responses\Fixtures\Vaults\Credentials;

final class VaultCredentialDeleteResponseFixture
{
    public const ATTRIBUTES = [
        'id' => 'credential_abc123',
        'object' => 'vault.credential.deleted',
        'deleted' => true,
    ];
}
