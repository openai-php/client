<?php

namespace OpenAI\Testing\Resources;

use OpenAI\Contracts\Resources\VaultCredentialsContract;
use OpenAI\Resources\VaultCredentials;
use OpenAI\Responses\Vaults\Credentials\VaultCredentialDeleteResponse;
use OpenAI\Responses\Vaults\Credentials\VaultCredentialListResponse;
use OpenAI\Responses\Vaults\Credentials\VaultCredentialResponse;
use OpenAI\Testing\Resources\Concerns\Testable;

final class VaultCredentialsTestResource implements VaultCredentialsContract
{
    use Testable;

    public function resource(): string
    {
        return VaultCredentials::class;
    }

    public function create(string $vaultId, array $parameters): VaultCredentialResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function list(string $vaultId, array $parameters = []): VaultCredentialListResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function retrieve(string $vaultId, string $credentialId): VaultCredentialResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function update(string $vaultId, string $credentialId, array $parameters): VaultCredentialResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function delete(string $vaultId, string $credentialId): VaultCredentialDeleteResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }
}
