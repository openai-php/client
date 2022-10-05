<?php

declare(strict_types=1);

namespace OpenAI\Responses\Models;

final class RetrieveResponsePermission
{
    private function __construct(
        public readonly string $id,
        public readonly string $object,
        public readonly int $created,
        public readonly bool $allowCreateEngine,
        public readonly bool $allowSampling,
        public readonly bool $allowLogprobs,
        public readonly bool $allowSearchIndices,
        public readonly bool $allowView,
        public readonly bool $allowFineTuning,
        public readonly string $organization,
        public readonly ?string $group,
        public readonly bool $isBlocking,
    ) {
    }

    /**
     * @param  array{id: string, object: string, created: int, allow_create_engine: bool, allow_sampling: bool, allow_logprobs: bool, allow_search_indices: bool, allow_view: bool, allow_fine_tuning: bool, organization: string, group: ?string, is_blocking: bool}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['object'],
            $attributes['created'],
            $attributes['allow_create_engine'],
            $attributes['allow_sampling'],
            $attributes['allow_logprobs'],
            $attributes['allow_search_indices'],
            $attributes['allow_view'],
            $attributes['allow_fine_tuning'],
            $attributes['organization'],
            $attributes['group'],
            $attributes['is_blocking'],
        );
    }

    /**
     * @return array{id: string, object: string, created: int, allow_create_engine: bool, allow_sampling: bool, allow_logprobs: bool, allow_search_indices: bool, allow_view: bool, allow_fine_tuning: bool, organization: string, group: ?string, is_blocking: bool}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'object' => $this->object,
            'created' => $this->created,
            'allow_create_engine' => $this->allowCreateEngine,
            'allow_sampling' => $this->allowSampling,
            'allow_logprobs' => $this->allowLogprobs,
            'allow_search_indices' => $this->allowSearchIndices,
            'allow_view' => $this->allowView,
            'allow_fine_tuning' => $this->allowFineTuning,
            'organization' => $this->organization,
            'group' => $this->group,
            'is_blocking' => $this->isBlocking,
        ];
    }
}
