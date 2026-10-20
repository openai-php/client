<?php

declare(strict_types=1);

namespace OpenAI\Responses\Vaults\Credentials;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type VaultCredentialAuthType array{type: 'mcp_oauth', mcp_server_url: string, expires_at: string|null, refresh: array{client_id: string, resource: string|null, scope: string|null, token_endpoint: string, token_endpoint_auth: array{type: 'none'|'client_secret_basic'|'client_secret_post'}}|null}|array{type: 'static_bearer', mcp_server_url: string}|array{type: 'environment_variable', secret_name: string, networking: array{type: 'unrestricted'}|array{type: 'limited', allowed_hosts: array<int, string>}}
 * @phpstan-type VaultCredentialType array{id: string, object: 'vault.credential', created_at: int, updated_at: int, vault_id: string, name: string, metadata: array<string, string>, auth: VaultCredentialAuthType}
 *
 * @implements ResponseContract<VaultCredentialType>
 */
final class VaultCredentialResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<VaultCredentialType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  'vault.credential'  $object
     * @param  array<string, string>  $metadata
     * @param  VaultCredentialAuthType  $auth
     */
    private function __construct(
        public readonly string $id,
        public readonly string $object,
        public readonly int $createdAt,
        public readonly int $updatedAt,
        public readonly string $vaultId,
        public readonly string $name,
        public readonly array $metadata,
        public readonly array $auth,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  VaultCredentialType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            id: $attributes['id'],
            object: $attributes['object'],
            createdAt: $attributes['created_at'],
            updatedAt: $attributes['updated_at'],
            vaultId: $attributes['vault_id'],
            name: $attributes['name'],
            metadata: $attributes['metadata'],
            auth: $attributes['auth'],
            meta: $meta,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'object' => $this->object,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
            'vault_id' => $this->vaultId,
            'name' => $this->name,
            'metadata' => $this->metadata,
            'auth' => $this->auth,
        ];
    }
}
