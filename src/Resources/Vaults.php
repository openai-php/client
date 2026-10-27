<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\VaultCredentialsContract;
use OpenAI\Contracts\Resources\VaultsContract;
use OpenAI\Responses\Vaults\VaultDeleteResponse;
use OpenAI\Responses\Vaults\VaultListResponse;
use OpenAI\Responses\Vaults\VaultResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

/**
 * @phpstan-import-type VaultType from VaultResponse
 * @phpstan-import-type VaultListType from VaultListResponse
 * @phpstan-import-type VaultDeleteType from VaultDeleteResponse
 */
final class Vaults implements VaultsContract
{
    use Concerns\Transportable;

    /**
     * Create a vault.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/vaults/methods/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters = []): VaultResponse
    {
        $payload = Payload::create('vaults', $parameters)->withHeader('OpenAI-Beta', 'agents=v1');

        /** @var Response<VaultType> $response */
        $response = $this->transporter->requestObject($payload);

        return VaultResponse::from($response->data(), $response->meta());
    }

    /**
     * List the vaults in the current project.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/vaults/methods/list
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters = []): VaultListResponse
    {
        $payload = Payload::list('vaults', $parameters)->withHeader('OpenAI-Beta', 'agents=v1');

        /** @var Response<VaultListType> $response */
        $response = $this->transporter->requestObject($payload);

        return VaultListResponse::from($response->data(), $response->meta());
    }

    /**
     * Retrieve a vault by its ID.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/vaults/methods/retrieve
     */
    public function retrieve(string $id): VaultResponse
    {
        $payload = Payload::retrieve('vaults', $id)->withHeader('OpenAI-Beta', 'agents=v1');

        /** @var Response<VaultType> $response */
        $response = $this->transporter->requestObject($payload);

        return VaultResponse::from($response->data(), $response->meta());
    }

    /**
     * Update a vault.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/vaults/methods/update
     *
     * @param  array<string, mixed>  $parameters
     */
    public function update(string $id, array $parameters): VaultResponse
    {
        $payload = Payload::modify('vaults', $id, $parameters)->withHeader('OpenAI-Beta', 'agents=v1');

        /** @var Response<VaultType> $response */
        $response = $this->transporter->requestObject($payload);

        return VaultResponse::from($response->data(), $response->meta());
    }

    /**
     * Delete a vault by its ID.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/vaults/methods/delete
     */
    public function delete(string $id): VaultDeleteResponse
    {
        $payload = Payload::delete('vaults', $id)->withHeader('OpenAI-Beta', 'agents=v1');

        /** @var Response<VaultDeleteType> $response */
        $response = $this->transporter->requestObject($payload);

        return VaultDeleteResponse::from($response->data(), $response->meta());
    }

    /**
     * Manage the credentials stored in a vault.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/vaults/subresources/credentials
     */
    public function credentials(): VaultCredentialsContract
    {
        return new VaultCredentials($this->transporter);
    }
}
