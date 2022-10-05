<?php

declare(strict_types=1);

namespace OpenAI\Responses\Models;

use OpenAI\Contracts\Response;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements Response<array{id: string, object: string, created: int, owned_by: string, permission: array<int, array{id: string, object: string, created: int, allow_create_engine: bool, allow_sampling: bool, allow_logprobs: bool, allow_search_indices: bool, allow_view: bool, allow_fine_tuning: bool, organization: string, group: ?string, is_blocking: bool}>, root: string, parent: ?string}>
 */
final class RetrieveResponse implements Response
{
    /**
     * @use ArrayAccessible<array{id: string, object: string, created: int, owned_by: string, permission: array<int, array{id: string, object: string, created: int, allow_create_engine: bool, allow_sampling: bool, allow_logprobs: bool, allow_search_indices: bool, allow_view: bool, allow_fine_tuning: bool, organization: string, group: ?string, is_blocking: bool}>, root: string, parent: ?string}>
     */
    use ArrayAccessible;

    /**
     * @param  array<int, RetrieveResponsePermission>  $permission
     */
    private function __construct(
        public readonly string $id,
        public readonly string $object,
        public readonly int $created,
        public readonly string $ownedBy,
        public readonly array $permission,
        public readonly string $root,
        public readonly ?string $parent,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id: string, object: string, created: int, owned_by: string, permission: array<int, array{id: string, object: string, created: int, allow_create_engine: bool, allow_sampling: bool, allow_logprobs: bool, allow_search_indices: bool, allow_view: bool, allow_fine_tuning: bool, organization: string, group: ?string, is_blocking: bool}>, root: string, parent: ?string}  $attributes
     */
    public static function from(array $attributes): self
    {
        $permission = array_map(fn (array $result): RetrieveResponsePermission => RetrieveResponsePermission::from(
            $result
        ), $attributes['permission']);

        return new self(
            $attributes['id'],
            $attributes['object'],
            $attributes['created'],
            $attributes['owned_by'],
            $permission,
            $attributes['root'],
            $attributes['parent'],
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
            'created' => $this->created,
            'owned_by' => $this->ownedBy,
            'permission' => array_map(
                static fn (RetrieveResponsePermission $result): array => $result->toArray(),
                $this->permission,
            ),
            'root' => $this->root,
            'parent' => $this->parent,
        ];
    }
}
