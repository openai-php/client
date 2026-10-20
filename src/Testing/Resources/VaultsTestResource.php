<?php

namespace OpenAI\Testing\Resources;

use OpenAI\Contracts\Resources\VaultCredentialsContract;
use OpenAI\Contracts\Resources\VaultsContract;
use OpenAI\Resources\Vaults;
use OpenAI\Responses\Vaults\VaultDeleteResponse;
use OpenAI\Responses\Vaults\VaultListResponse;
use OpenAI\Responses\Vaults\VaultResponse;
use OpenAI\Testing\Resources\Concerns\Testable;

final class VaultsTestResource implements VaultsContract
{
    use Testable;

    public function resource(): string
    {
        return Vaults::class;
    }

    public function create(array $parameters = []): VaultResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function list(array $parameters = []): VaultListResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function retrieve(string $id): VaultResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function update(string $id, array $parameters): VaultResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function delete(string $id): VaultDeleteResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function credentials(): VaultCredentialsContract
    {
        return new VaultCredentialsTestResource($this->fake);
    }
}
