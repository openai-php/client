<?php

declare(strict_types=1);

namespace OpenAI\Contracts\Resources;

use OpenAI\Responses\Vaults\Credentials\VaultCredentialDeleteResponse;
use OpenAI\Responses\Vaults\Credentials\VaultCredentialListResponse;
use OpenAI\Responses\Vaults\Credentials\VaultCredentialResponse;

interface VaultCredentialsContract
{
    /**
     * Create a credential in a vault.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/vaults/subresources/credentials/methods/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(string $vaultId, array $parameters): VaultCredentialResponse;

    /**
     * List the credentials in a vault.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/vaults/subresources/credentials/methods/list
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(string $vaultId, array $parameters = []): VaultCredentialListResponse;

    /**
     * Retrieve a vault credential.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/vaults/subresources/credentials/methods/retrieve
     */
    public function retrieve(string $vaultId, string $credentialId): VaultCredentialResponse;

    /**
     * Update a vault credential.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/vaults/subresources/credentials/methods/update
     *
     * @param  array<string, mixed>  $parameters
     */
    public function update(string $vaultId, string $credentialId, array $parameters): VaultCredentialResponse;

    /**
     * Delete a vault credential.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/vaults/subresources/credentials/methods/delete
     */
    public function delete(string $vaultId, string $credentialId): VaultCredentialDeleteResponse;
}
