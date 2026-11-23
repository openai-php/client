<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\SkillsContract;
use OpenAI\Contracts\Resources\SkillVersionsContract;
use OpenAI\Responses\Skills\SkillDeleteResponse;
use OpenAI\Responses\Skills\SkillListResponse;
use OpenAI\Responses\Skills\SkillResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

/**
 * @phpstan-import-type SkillType from SkillResponse
 * @phpstan-import-type SkillListType from SkillListResponse
 * @phpstan-import-type SkillDeleteType from SkillDeleteResponse
 */
final class Skills implements SkillsContract
{
    use Concerns\Transportable;

    /**
     * Create a new skill by uploading its files (directory upload) or a single zip bundle.
     *
     * @see https://developers.openai.com/api/reference/resources/skills/methods/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): SkillResponse
    {
        $payload = Payload::upload('skills', $parameters);

        /** @var Response<SkillType> $response */
        $response = $this->transporter->requestObject($payload);

        return SkillResponse::from($response->data(), $response->meta());
    }

    /**
     * List all skills for the current project.
     *
     * @see https://developers.openai.com/api/reference/resources/skills/methods/list
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters = []): SkillListResponse
    {
        $payload = Payload::list('skills', $parameters);

        /** @var Response<SkillListType> $response */
        $response = $this->transporter->requestObject($payload);

        return SkillListResponse::from($response->data(), $response->meta());
    }

    /**
     * Get a skill by its ID.
     *
     * @see https://developers.openai.com/api/reference/resources/skills/methods/retrieve
     */
    public function retrieve(string $id): SkillResponse
    {
        $payload = Payload::retrieve('skills', $id);

        /** @var Response<SkillType> $response */
        $response = $this->transporter->requestObject($payload);

        return SkillResponse::from($response->data(), $response->meta());
    }

    /**
     * Update the default version pointer for a skill.
     *
     * @see https://developers.openai.com/api/reference/resources/skills/methods/update
     *
     * @param  array<string, mixed>  $parameters
     */
    public function update(string $id, array $parameters): SkillResponse
    {
        $payload = Payload::modify('skills', $id, $parameters);

        /** @var Response<SkillType> $response */
        $response = $this->transporter->requestObject($payload);

        return SkillResponse::from($response->data(), $response->meta());
    }

    /**
     * Download a skill zip bundle by its ID.
     *
     * @see https://developers.openai.com/api/reference/resources/skills/subresources/content/methods/retrieve
     */
    public function content(string $id): string
    {
        $payload = Payload::retrieveContent('skills', $id);

        return $this->transporter->requestContent($payload, requireSuccess: true);
    }

    /**
     * Delete a skill by its ID.
     *
     * @see https://developers.openai.com/api/reference/resources/skills/methods/delete
     */
    public function delete(string $id): SkillDeleteResponse
    {
        $payload = Payload::delete('skills', $id);

        /** @var Response<SkillDeleteType> $response */
        $response = $this->transporter->requestObject($payload);

        return SkillDeleteResponse::from($response->data(), $response->meta());
    }

    /**
     * Manage the immutable versions of a skill.
     *
     * @see https://developers.openai.com/api/reference/resources/skills/subresources/versions
     */
    public function versions(): SkillVersionsContract
    {
        return new SkillVersions($this->transporter);
    }
}
