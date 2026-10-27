<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\VaultCredentialsContract;
use OpenAI\Responses\Vaults\Credentials\VaultCredentialDeleteResponse;
use OpenAI\Responses\Vaults\Credentials\VaultCredentialListResponse;
use OpenAI\Responses\Vaults\Credentials\VaultCredentialResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

/**
 * @phpstan-import-type VaultCredentialType from VaultCredentialResponse
 * @phpstan-import-type VaultCredentialListType from VaultCredentialListResponse
 * @phpstan-import-type VaultCredentialDeleteType from VaultCredentialDeleteResponse
 */
final class VaultCredentials implements VaultCredentialsContract
{
    use Concerns\Transportable;

    /**
     * Create a credential in a vault.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/vaults/subresources/credentials/methods/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(string $vaultId, array $parameters): VaultCredentialResponse
    {
        $payload = Payload::create("vaults/$vaultId/credentials", $parameters)->withHeader('OpenAI-Beta', 'agents=v1');

        /** @var Response<VaultCredentialType> $response */
        $response = $this->transporter->requestObject($payload);

        return VaultCredentialResponse::from($response->data(), $response->meta());
    }

    /**
     * List the credentials in a vault.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/vaults/subresources/credentials/methods/list
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(string $vaultId, array $parameters = []): VaultCredentialListResponse
    {
        $payload = Payload::list("vaults/$vaultId/credentials", $parameters)->withHeader('OpenAI-Beta', 'agents=v1');

        /** @var Response<VaultCredentialListType> $response */
        $response = $this->transporter->requestObject($payload);

        return VaultCredentialListResponse::from($response->data(), $response->meta());
    }

    /**
     * Retrieve a vault credential.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/vaults/subresources/credentials/methods/retrieve
     */
    public function retrieve(string $vaultId, string $credentialId): VaultCredentialResponse
    {
        $payload = Payload::retrieve("vaults/$vaultId/credentials", $credentialId)->withHeader('OpenAI-Beta', 'agents=v1');

        /** @var Response<VaultCredentialType> $response */
        $response = $this->transporter->requestObject($payload);

        return VaultCredentialResponse::from($response->data(), $response->meta());
    }

    /**
     * Update a vault credential.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/vaults/subresources/credentials/methods/update
     *
     * @param  array<string, mixed>  $parameters
     */
    public function update(string $vaultId, string $credentialId, array $parameters): VaultCredentialResponse
    {
        $payload = Payload::modify("vaults/$vaultId/credentials", $credentialId, $parameters)->withHeader('OpenAI-Beta', 'agents=v1');

        /** @var Response<VaultCredentialType> $response */
        $response = $this->transporter->requestObject($payload);

        return VaultCredentialResponse::from($response->data(), $response->meta());
    }

    /**
     * Delete a vault credential.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/vaults/subresources/credentials/methods/delete
     */
    public function delete(string $vaultId, string $credentialId): VaultCredentialDeleteResponse
    {
        $payload = Payload::delete("vaults/$vaultId/credentials", $credentialId)->withHeader('OpenAI-Beta', 'agents=v1');

        /** @var Response<VaultCredentialDeleteType> $response */
        $response = $this->transporter->requestObject($payload);

        return VaultCredentialDeleteResponse::from($response->data(), $response->meta());
    }
}
