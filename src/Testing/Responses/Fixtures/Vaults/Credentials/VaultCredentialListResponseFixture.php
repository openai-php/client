<?php

namespace OpenAI\Testing\Responses\Fixtures\Vaults\Credentials;

final class VaultCredentialListResponseFixture
{
    public const ATTRIBUTES = [
        'object' => 'list',
        'data' => [
            VaultCredentialResponseFixture::ATTRIBUTES,
        ],
        'first_id' => 'credential_abc123',
        'last_id' => 'credential_abc123',
        'has_more' => false,
    ];
}
