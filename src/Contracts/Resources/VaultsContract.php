<?php

declare(strict_types=1);

namespace OpenAI\Contracts\Resources;

use OpenAI\Responses\Vaults\VaultDeleteResponse;
use OpenAI\Responses\Vaults\VaultListResponse;
use OpenAI\Responses\Vaults\VaultResponse;

interface VaultsContract
{
    /**
     * Create a vault.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/vaults/methods/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters = []): VaultResponse;

    /**
     * List the vaults in the current project.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/vaults/methods/list
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters = []): VaultListResponse;

    /**
     * Retrieve a vault by its ID.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/vaults/methods/retrieve
     */
    public function retrieve(string $id): VaultResponse;

    /**
     * Update a vault.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/vaults/methods/update
     *
     * @param  array<string, mixed>  $parameters
     */
    public function update(string $id, array $parameters): VaultResponse;

    /**
     * Delete a vault by its ID.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/vaults/methods/delete
     */
    public function delete(string $id): VaultDeleteResponse;

    /**
     * Manage the credentials stored in a vault.
     *
     * @see https://developers.openai.com/api/reference/resources/beta/subresources/agents/subresources/vaults/subresources/credentials
     */
    public function credentials(): VaultCredentialsContract;
}
